<?php

/**
 * The file that defines the core plugin class
 * @link       vitaliypichugin92@gmail.com
 * @since      1.0.0
 *
 * @package    Parse_weather
 * @subpackage Parse_weather/includes
 */


class Parse_weather {

	protected $loader;

	protected $plugin_name;

	protected $version;


	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'parse_weather';

		$this->load_dependencies();

		switch ($_POST['type']){
            case 'day1':
                $this->draw_table($this->get_data_gismetio('#tbwdaily1>tr'));
                break;
            case 'day2':
                $this->draw_table($this->get_data_gismetio('#tbwdaily2>tr'));
                break;
            case 'day3':
                $this->draw_table($this->get_data_gismetio('#tbwdaily3>tr'));
                break;
            default:{
                $this->draw_table($this->get_data_gismetio('#tbwdaily1>tr'));
                break;
            }
        }
	}

	//include file in which data is transferred and displayed
	private function draw_table($data){
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/parse_weather-public-display.php';
    }

	private function get_data_gismetio($selector){
        $query_url = "https://www.gismeteo.ua/weather-zaporizhia-5093/";

        $return = $this->get_web_page($query_url);
        if(!$return['errno']) {
            $document = phpQuery::newDocument($return['content']);
            $rows = [];
            foreach ($document->find($selector) as $key => $item) {
                $rows[$key]['th'] = pq($item)->find("th")->text();
                $rows[$key]['img'] = pq($item)->find("img")->attr('src');
                $rows[$key]['climate'] = pq($item)->find(".cltext")->text();
                $rows[$key]['temp'] = pq($item)->find(".c:eq(0)")->text();
                $rows[$key]['atmosphere'] = pq($item)->find(".m_press:eq(0)")->text();
                $rows[$key]['air'] = pq($item)->find(".wicon ")->attr('title') . '<br>(' . pq($item)->find('.ms') . ' м/с)';
                $rows[$key]['humidity'] = pq($item)->find("td:eq(5)")->text();
                $rows[$key]['feel'] = pq($item)->find(".c:eq(1)")->text();
            }
            return $rows;
        }else{
          //var_dump($return['errmsg']);
          return false;
        }
    }

    //function for get content wep page
   private function get_web_page( $url )
    {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
        );

        $ch = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header;
    }

    //include libray and classes
	private function load_dependencies() {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/lib/phpQuery.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-parse_weather-loader.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-parse_weather-public.php';

		$this->loader = new Parse_weather_Loader();

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 */
	public function run() {
		$this->loader->run();
	}


}
