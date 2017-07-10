<?php
class ModelShippingDhl4You extends Model {
	function getQuote($address) {
		$this->load->language('shipping/dhl4you');

      	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('dhl4you_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

      	if (!$this->config->get('dhl4you_geo_zone_id')) {
        	$status = true;
      	} elseif ($query->num_rows) {
        	$status = true;
      	} else {
        	$status = false;
      	}

		if ($this->config->get('dhl4you_use_freeshipping')) {
			if ($address['iso_code_2'] === 'NL') {
				if ($this->cart->getSubTotal() > $this->config->get('free_total')) {
					$status = false;
				}
			}
		}
		
		$method_data = array();

		$verzendkosten = 0;
		$dhl4you_box = false;
		$error = FALSE;
		$quote_data = array();
		$icon = '<img src="image/catalog/dhl4you_logo.png" align="absmiddle" />';


	if ($status) {
		//Query to find id of grams (g) as 1.5.1.1 removed the availability of the named unit
		$unit_query =  $this->db->query("SELECT weight_class_id FROM " . DB_PREFIX . "weight_class_description where LOWER(unit) = 'g'");

		if ($unit_query->num_rows) {$unit_g = $unit_query->row['weight_class_id'];}

		$weight = intval($this->weight->convert($this->cart->getWeight(), $this->config->get('config_weight_class_id'), $unit_g));

		//$weight = floatval($this->weight->convert($this->cart->getWeight(), $this->config->get('config_weight_class'), 'g'));
		if ($weight >= 1000) {
			$show_weight = floatval($this->weight->convert($this->cart->getWeight(), $this->config->get('config_weight_class_id'), $unit_g) / 1000);
			$kg = $this->language->get('text_showweight_kilo');

		}
		if ($weight < 1000) {
			$show_weight = floatval($this->weight->convert($this->cart->getWeight(), $this->config->get('config_weight_class_id'), $unit_g));
			$kg = $this->language->get('text_showweight_gram');

		}


		// hier routine maken om door te bepelan.
		// als kleine doos dan
		// anders is het een grote dooe


			$blenght = 378;
			$bwidth = 263;
			$bheight = 30;
			$bweight = 150;
			$cboxweight = 500;

			// vanaf hier kijken naar het totale verzend formaat
			$boxlenght = $blenght; 	// komt straks uit tabel
			$boxwidth = $bwidth;	// komt straks uit tabel
			$boxheight = $bheight;	// komt straks uit tabel
			$boxweight = $bweight;	// komt straks uit tabel
			$max = 0;
			$stuk_lenght = 0;
			$stuk_width = 0;
			$stuk_height = 0;
			$dhl4you_box = false;

		if ($weight + $bweight > 10000 || $weight + $cboxweight > 10000) {
			$status = false;
		}


			require_once(DIR_APPLICATION . 'model/shipping/boxing.class.php');
			$b = new boxing();
			$b -> add_outer_box($boxlenght,$boxwidth,$boxheight);

			// Query to find out if mm are configured in the database because OpenCart developers thought it wasn't needed in the API (currently no error condition if it doesn't exist)
			$unit_query =  $this->db->query("SELECT length_class_id FROM " . DB_PREFIX . "length_class_description where LOWER(unit) = 'mm'");

			if ($unit_query->num_rows) {$unit_mm = $unit_query->row['length_class_id'];}

			foreach ($this->cart->getProducts() as $cartitem) {
				if($cartitem['width'] != 0) {
					$cartitem['width'] = $this->length->convert($cartitem['width'], $cartitem['length_class_id'], $unit_mm);
				} else {
					$cartitem['width'] = 100;
				}

				if($cartitem['height'] != 0) {
					$cartitem['height'] = $this->length->convert($cartitem['height'], $cartitem['length_class_id'], $unit_mm);
				} else {
					$cartitem['height'] = 100;
				}

				if($cartitem['length'] != 0) {
					$cartitem['length'] = $this->length->convert($cartitem['length'], $cartitem['length_class_id'], $unit_mm);
				} else {
					$cartitem['length'] = 100;
				}

				for ($i = 1; $i <= $cartitem['quantity']; $i++) $b -> add_inner_box($cartitem['length'], $cartitem['width'], $cartitem['height']);
			}
			// eind formaat bepaling

			if ($b -> fits()) {
				$dhl4you_box = true;
			} elseif (!$b -> fits()) {
				$dhl4you_box = false;
			}

			// Nederland

			if ($b -> fits() && $address['iso_code_2'] != 'NL') {

				$dhl4you_box = false;
			}

			if ($b -> fits() && $dhl4you_box == true && $address['iso_code_2'] == 'NL') {
				$weight = $weight + $boxweight;

				if ($this->config->get('dhl4you_small_cost') && $address['iso_code_2'] == 'NL') {
					$cost = 0;

					//$image = '<img src="image/data/small_box.png" align="absmiddle" />&nbsp;';

					$title_dhl4you = $this->language->get('text_dhl4you_title');
					$title = $this->language->get('text_dhl4you_small_parcel');

					$verzendkosten = $this->config->get('dhl4you_small_cost');



				if ($weight <= 0) {
					$error = $this->language->get('error_zero_weight');
				}


				$quote_data['dhl4you_small_parcel'] = array(
					'code' => 'dhl4you.dhl4you_small_parcel',
					'title' => $title,
					'cost' => $verzendkosten,
					'tax_class_id' => $this->config->get('dhl4you_tax_class_id'),
					'text' => $this->currency->format($this->tax->calculate($verzendkosten, $this->config->get('dhl4you_tax_class_id'), $this->config->get('config_tax')))
					);
				}
			}

		if($dhl4you_box == false) {

			if ($this->config->get('dhl4you_large_cost') && $address['iso_code_2'] == 'NL') {
				$weight = $weight + $cboxweight;

				$cost = 0;
				$title_dhl4you = $this->language->get('text_dhl4you_title');
				$title = $this->language->get('text_dhl4you_large_parcel');


				$help_text = $this->language->get('text_dhl4you_large_parcel');

				$verzendkosten = $this->config->get('dhl4you_large_cost');


			$quote_data['dhl4you_large_parcel'] = array(
				'code' => 'dhl4you.dhl4you_large_parcel',
				'title' => $title,
				'cost' => $verzendkosten,
				'tax_class_id' => $this->config->get('dhl4you_tax_class_id'),
				'text' => $this->currency->format($this->tax->calculate($verzendkosten, $this->config->get('dhl4you_tax_class_id'), $this->config->get('config_tax')))
				);
			}


		// zone 1

			if ($this->config->get('dhl4you_germany_cost') && $address['iso_code_2'] == 'DE') {
				$weight = $weight + $cboxweight;

				$cost = 0;

				$title_dhl4you = $this->language->get('text_dhl4you_title');
				$title = $this->language->get('text_dhl4you_large_parcel');

				$help_text = $this->language->get('text_dhl4you_large_parcel');

				$verzendkosten = $this->config->get('dhl4you_germany_cost');

				$quote_data['dhl4you_germany_parcel'] = array(
							'code' => 'dhl4you.dhl4you_germany_parcel',
							'title' => $title,
							'cost' => $verzendkosten,
							'tax_class_id' => $this->config->get('dhl4you_tax_class_id'),
							'text' => $this->currency->format($this->tax->calculate($verzendkosten, $this->config->get('dhl4you_tax_class_id'), $this->config->get('config_tax')))
							);
			}


		// West Europa
		// Zone 2
			$countries = explode(',', 'AT,AX,BE,DK,ES,FI,FR,GB,IE,IT,LU,PL,PT,SE,IB,CE,GG,JE');

			if ($this->config->get('dhl4you_westeurope_cost') && in_array($address['iso_code_2'], $countries)) {
				$weight = $weight + $cboxweight;

				$cost = 0;

				$title_dhl4you = $this->language->get('text_dhl4you_title');
				$title = $this->language->get('text_dhl4you_large_parcel');

				$help_text = $this->language->get('text_dhl4you_large_parcel');

				$verzendkosten = $this->config->get('dhl4you_westeurope_cost');

				$quote_data['dhl4you_westeurope_parcel'] = array(
							'code' => 'dhl4you.dhl4you_westeurope_parcel',
							'title' => $title,
							'cost' => $verzendkosten,
							'tax_class_id' => $this->config->get('dhl4you_tax_class_id'),
							'text' => $this->currency->format($this->tax->calculate($verzendkosten, $this->config->get('dhl4you_tax_class_id'), $this->config->get('config_tax')))
							);
			}

			// Rest of Europa
			// Zone 3
			$countries = explode(',', 'AL,AD,BA,BG,BY,NO,CY,EE,GI,GR,GL,HU,CS,HR,LV,LI,LT,MK,MT,MD,MC,ME,RO,SM,RS,SI,SK,SJ,CZ,TR,VA,CH,CN');

			if ($this->config->get('dhl4you_europe_cost') && in_array($address['iso_code_2'], $countries)) {
				$dhl4you_box == 0;
				$weight = $weight + $cboxweight;

				$cost = 0;

				$title_dhl4you = $this->language->get('text_dhl4you_title');
				$title = $this->language->get('text_dhl4you_large_parcel');

				$help_text = $this->language->get('text_dhl4you_large_parcel');

				$verzendkosten = $this->config->get('dhl4you_europe_cost');


				$quote_data['dhl4you_europe_parcel'] = array(
							'code' => 'dhl4you.dhl4you_europe_parcel',
							'title' => $title,
							'cost' => $verzendkosten,
							'tax_class_id' => $this->config->get('dhl4you_tax_class_id'),
							'text' => $this->currency->format($this->tax->calculate($verzendkosten, $this->config->get('dhl4you_tax_class_id'), $this->config->get('config_tax')))
							);
			}

		// Rest van de wereld
		// zone 4
			$countries = explode(',', 'NL,AT,AX,BE,DE,DK,ES,FI,FR,GB,IE,IT,LU,PL,PT,SE,IB,CE,GG,JE,AL,AD,BA,BG,BY,NO,CY,EE,GI,GR,GL,HU,CS,HR,LV,LI,LT,MK,MT,MD,MC,ME,RO,SM,RS,SI,SK,SJ,CZ,TR,VA,CH,CN');

			if ($this->config->get('dhl4you_world_cost') && !(in_array($address['iso_code_2'], $countries))) {
				$weight = $weight + $cboxweight;

				$cost = 0;

				$title_dhl4you = $this->language->get('text_dhl4you_title');
				$title = $this->language->get('text_dhl4you_large_parcel');

				$help_text = $this->language->get('text_dhl4you_large_parcel');

				$verzendkosten = $this->config->get('dhl4you_world_cost');

				$quote_data['dhl4you_world_parcel'] = array(
							'code' => 'dhl4you.dhl4you_world_parcel',
							'title' => $title,
							'cost' => $verzendkosten,
							'tax_class_id' => $this->config->get('dhl4you_tax_class_id'),
							'text' => $this->currency->format($this->tax->calculate($verzendkosten, $this->config->get('dhl4you_tax_class_id'), $this->config->get('config_tax')))
							);
			}
		}
	}

		if ($quote_data) {
      		$method_data = array(
        		'code'         => 'dhl4you',
        		'title' 	 => $icon . ' ' . $title_dhl4you,
        		'quote'      => $quote_data,
				'sort_order' => $this->config->get('dhl4you_sort_order'),
        		'error'      => $error
      		);
		}
		return $method_data;
	}
}
?>