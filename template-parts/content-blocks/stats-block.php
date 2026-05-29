<?php 
	if( have_rows('stats_block') ): 
	$fullwidth = get_field('full_width_blocks');
?>
   
	<section class="stats-block m-0! <?php if( $fullwidth ) {echo ' fullwidth';} ?> overflow-hidden" aria-label="Staggered content">
		<div class="grid grid-flow-row grid-cols-12 gap-0">

			<?php while( have_rows('stats_block') ): the_row();
				$block_title = get_sub_field('block_title');
				$block_text = get_sub_field('block_text');
				$stats_display = get_sub_field('stats_display');

				if( $stats_display == 'accordion' ) :
			?>
			
				<div class="text-block col-span-12 bg-secondary">
					<div class="content-inner p-8 lg:p-20 w-full lg:h-full">
						<?php if( $block_title ) { echo '<h3 class="block-bottom mb-6 mt-0!">' .esc_html($block_title). '</h3>'; } ?>
						<?php if( $block_text ) { echo '<div class="copy-wrap">' .$block_text. '</div>'; } ?>

						<?php if( have_rows('accordion' )): ?>
						
							<div class="accordions space-y-0 mt-6" x-data="{ openAccordion: null }">
								<?php
									$hash=rand(1,999999);
									$counter=1;
									while( have_rows('accordion') ): the_row(); 
									$accordion_title = get_sub_field('accordion_title');
									$accordion_text = get_sub_field('accordion_text');
								?>
									<?php if($accordion_title ) : ?>
										<div class="accordion-title">
											<div class="border-b border-gray-200 last:border-b-0" id="heading-<?php echo $hash.'-'.$counter; ?>">
												<div>
													<button 
														class="w-full py-4 text-left flex justify-between items-center transition-colors duration-200 cursor-pointer" 
														type="button" 
														@click="openAccordion = openAccordion === <?php echo $counter; ?> ? null : <?php echo $counter; ?>"
														:aria-expanded="openAccordion === <?php echo $counter; ?>"
														aria-controls="collapse-<?php echo $hash.'-'.$counter; ?>"
													>
														<span class="text-lg font-bold text-dark pr-4"><?php echo $accordion_title; ?></span>
														<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" :class="{ 'rotate-45': openAccordion === <?php echo $counter; ?> }" class="transition" style="height: 20px;">
															<path d="M336 112C336 103.2 328.8 96 320 96C311.2 96 304 103.2 304 112L304 304L112 304C103.2 304 96 311.2 96 320C96 328.8 103.2 336 112 336L304 336L304 528C304 536.8 311.2 544 320 544C328.8 544 336 536.8 336 528L336 336L528 336C536.8 336 544 328.8 544 320C544 311.2 536.8 304 528 304L336 304L336 112z"/>
														</svg>
													</button>
												</div>
											</div>
											<?php if($accordion_text ) : ?>
												<div 
													id="collapse-<?php echo $hash.'-'.$counter++; ?>" 
													class="overflow-hidden transition-all duration-300 ease-in-out"
													:class="openAccordion === <?php echo $counter-1; ?> ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'"
												>
													<div class="px-6 py-4">
														<div class="max-w-none">
															<?php echo $accordion_text; ?>
														</div>
													</div>
												</div>
											<?php endif; ?>
										</div>
									<?php endif; ?>
								<?php endwhile; ?>
							</div>

						<?php endif; ?>
							
						
					</div>
				</div>

			<?php elseif( $stats_display == 'statistics' ) : ?>

				<div class="text-block col-span-12 bg-dark text-white">
					<div class="content-inner p-8 lg:p-20 w-full lg:h-full">
						<?php if( $block_title ) { echo '<h3 class="block-bottom mb-6 mt-0!">' .esc_html($block_title). '</h3>'; } ?>
						<?php if( $block_text ) { echo '<div class="copy-wrap">' .$block_text. '</div>'; } ?>
							
						<?php if( have_rows('statistics') ): ?>
							<div class="statistics">
								<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
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

									<?php endwhile; ?>

								</div>
							</div>
						<?php endif; ?>
					
					</div>
				</div>

			<?php endif; endwhile; ?>

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