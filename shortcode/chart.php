<?php
/**
 * Adsense ad shortcode
 *
 * Wrtie [adsense] in your post editor to render this shortcode.
 *
 * @package	 ABS
 * @since    1.0.0
 */

if ( ! function_exists( 'chart_shortcode' ) ) {
	// Add the action.
	add_action( 'plugins_loaded', function() {
		// Add the shortcode.
		add_shortcode( 'chart', 'chart_shortcode' );
	});

	/**
	 * Chart shortcode.
	 *
	 * @return string Shortcode output string.
	 * @since  1.0.0
	 */
	function chart_shortcode($atts = [], $content = null, $tag = '') {
		// normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);

		$atts['labels'] = preg_split ("/\,/", $atts['labels']);
		$atts['data'] = preg_split ("/\,/", $atts['data']);

    // set and override default attributes
    $atts = shortcode_atts([
			'type' => 'radar',
			'labels' => array('Skating','Shooting','Passing','Stick Handling','Tactics','Positioning'),
			'data' => array('50', '50', '50', '50', '50', '50')
		], $atts, $tag);
		return "<canvas id='myChart' width='400' height='400'></canvas>
						<script>
						Chart.plugins.register({
						  beforeDraw: function(chartInstance) {
						    var ctx = document.getElementById('myChart').getContext('2d');
						    ctx.fillStyle = 'rgba(38, 33, 33, 1)';
						    ctx.fillRect(0, 0, chartInstance.chart.width, chartInstance.chart.height);
						  }
						});
						var ctx = document.getElementById('myChart').getContext('2d');
						var myChart = new Chart(ctx, {
						    type: '" . $atts['type'] . "',
								backgroundColor: 'rgba(255, 255, 255, 0.8)',
						    data: {
						        labels: " . json_encode($atts['labels']) . ",
						        datasets: [{
						            label: 'Skill Percentage',
						            data: " . json_encode($atts['data']) . ",
						            backgroundColor: [
						                'rgba(204, 51, 51, 0.4)',
						                'rgba(54, 162, 235, 0.2)',
						                'rgba(255, 206, 86, 0.2)',
						                'rgba(75, 192, 192, 0.2)',
						                'rgba(153, 102, 255, 0.2)',
						                'rgba(255, 159, 64, 0.2)'
						            ],
						            borderColor: [
						                'rgba(204, 51, 51, 1)',
						                'rgba(54, 162, 235, 1)',
						                'rgba(255, 206, 86, 1)',
						                'rgba(75, 192, 192, 1)',
						                'rgba(153, 102, 255, 1)',
						                'rgba(255, 159, 64, 1)'
						            ],
						            borderWidth: 4
						        }]
						    },
						    options: {
									legend: {
							      position: 'top',
							      labels: {
							        fontColor: 'white'
							      }
							    },
							    title: {
							      display: true,
							      text: 'Your Hockey Skills',
							      fontColor: 'white'
							    },
							    scale: {
							      ticks: {
											max:100,
											min: 0,
											beginAtZero: false,
							        fontColor: 'white', // labels such as 10, 20, etc
							        showLabelBackdrop: false // hide square behind text
							      },
							      pointLabels: {
							        fontColor: 'white' // labels around the edge like 'Running'
							      },
							      gridLines: {
							        color: 'rgba(255, 255, 255, 0.2)'
							      },
							      angleLines: {
							        color: 'white' // lines radiating from the center
							      }
							    }
								}
						});
						</script>";
	}
}
