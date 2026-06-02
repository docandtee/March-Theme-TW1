<?php
	$background_colour = get_field('background_colour');
	$section_heading = get_field('section_heading');
	$section_copy = get_field('section_copy');
	$number_of_columns = get_field('number_of_columns');
	if( have_rows('statistics') ): 
?>

	<section class="stats-block <?php echo esc_attr($background_colour); ?> fullwidth overflow-hidden section-p-t section-p-b" aria-label="statistics content">
		<div class="container">
			<?php if($section_heading) {
				echo '<h2 class="mb-4 mt-0!">' . esc_html($section_heading) . '</h2>';
			} ?>
			<?php if($section_copy) {
				echo '<div class="section-copy">' . $section_copy . '</div>';
			} ?>
			<div class="grid grid-flow-row grid-cols-12 md:gap-8 mt-12">

				<?php
					while( have_rows('statistics') ): the_row();
					$stats_number = get_sub_field('stats_number');
					$stats_description = get_sub_field('stats_description');
					$percentage = get_sub_field('percentage');
					$stats_figure_string = is_scalar($stats_number) ? (string) $stats_number : '';
					$numeric_candidate = preg_replace('/[^0-9.\-]/', '', $stats_figure_string);
					$target_number = is_numeric($numeric_candidate) ? (float) $numeric_candidate : null;
					$decimal_places = 0;
					if (null !== $target_number && str_contains((string) $numeric_candidate, '.')) {
						$decimal_parts = explode('.', (string) $numeric_candidate);
						$decimal_places = isset($decimal_parts[1]) ? strlen($decimal_parts[1]) : 0;
					}
					$stats_figure_fallback_json = wp_json_encode(
						$stats_figure_string,
						JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
					);
					$counter_config_json = wp_json_encode(
						array(
							'target' => $target_number,
							'decimals' => $decimal_places,
							'fallback' => json_decode($stats_figure_fallback_json, true),
						),
						JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
					);
				?>
					<div class="col-span-12 md:col-span-6 <?php echo esc_attr($number_of_columns); ?> mb-4 md:mb-0">
						<div class="flex flex-col items-center border-t-3 border-primary p-8 bg-tertiary">
							<div 
								class="impact-stat-block"
								x-data='impactStatCounter(<?php echo esc_attr($counter_config_json); ?>)' 
								x-intersect.threshold.50="shown = true; startCounter()" 
								x-intersect:leave="shown = false"
							>
								<div 
									class="p-2 text-4xl font-bold text-center"
									x-show="shown" 
									x-transition:enter="transition ease-out duration-300"
									x-transition:enter-start="opacity-0 scale-50"
									x-transition:enter-end="opacity-100 scale-100"
									x-transition:leave="transition ease-in duration-300"
									x-transition:leave-start="opacity-100 scale-100"
									x-transition:leave-end="opacity-0 scale-90"
								>
								<?php if( $stats_number )  {
									echo '<span x-text="valueDisplay"></span>';
									if( $percentage ) { echo '<span class="percentage-symbol">%</span>'; }
								} ?>
								</div>
							</div>

							<?php if($stats_description) { echo '<div class="stat-description text-center">' . $stats_description . '</div>'; } ?>
						</div>
					</div>

				<?php endwhile; ?>

			</div>
		</div>
	</section>

	<script>
		if (!window.impactStatCounter) {
			window.impactStatCounter = function impactStatCounter(config) {
				return {
					shown: false,
					hasAnimated: false,
					target: config && typeof config.target === "number" ? config.target : null,
					duration: 1400,
					decimals: config && typeof config.decimals === "number" ? config.decimals : 0,
					fallback: config && typeof config.fallback === "string" ? config.fallback : "",
					value: 0,
					get valueDisplay() {
						if (this.target === null) return this.fallback;
						return this.value.toLocaleString(undefined, {
							minimumFractionDigits: this.decimals,
							maximumFractionDigits: this.decimals
						});
					},
					startCounter() {
						if (this.hasAnimated || this.target === null) return;
						this.hasAnimated = true;
						const start = 0;
						const end = this.target;
						const duration = this.duration;
						const startedAt = performance.now();
						const tick = (now) => {
							const progress = Math.min((now - startedAt) / duration, 1);
							const eased = 1 - Math.pow(1 - progress, 3);
							this.value = start + ((end - start) * eased);
							if (progress < 1) {
								requestAnimationFrame(tick);
								return;
							}
							this.value = end;
						};
						requestAnimationFrame(tick);
					}
				};
			};
		}
	</script>
<?php endif; ?>