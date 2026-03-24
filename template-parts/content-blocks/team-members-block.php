<?php 
	if( have_rows('team_member') ): 
	$fullwidth = get_field('full_width_blocks');
	$remove_bottom_margin = get_field('remove_bottom_margin');
	$section_header = get_field('section_header');
?>
   
<section class="team-members-block section-p-t <?php if(!$remove_bottom_margin) { echo ' section-m-b '; } if( $fullwidth ) {echo ' fullwidth';} ?> overflow-hidden" aria-label="Team Members" x-data="teamModal()">
	<div class="container">

		<?php if($section_header) : ?>
			<div class="grid grid-flow-row grid-cols-12">
				<header class="col-span-12 text-center">
					<h2 class="section-m-b"><?php echo esc_html($section_header); ?></h2>
				</header>
			</div>
		<?php endif; ?>

		<div class="flex flex-row flex-wrap justify-center">

			<?php 
				// First pass: collect all data and generate hashes
				$team_members = array();
				if( have_rows('team_member') ) {
					while( have_rows('team_member') ): the_row();
						$hash = md5(rand(111111,999999) . '-' . date('YMDHis'));
						$image = get_sub_field('team_member_photo');
						$team_member_name = get_sub_field('team_member_name');
						$team_member_bio = get_sub_field('team_member_bio');
						$team_member_role = get_sub_field('team_member_role');
						$linkedin = get_sub_field('linkedin');
						
						$team_members[] = array(
							'hash' => $hash,
							'image' => $image,
							'name' => $team_member_name,
							'bio' => $team_member_bio,
							'role' => $team_member_role,
							'linkedin' => $linkedin
						);
					endwhile;
				}
				
				// Second pass: display the members
				foreach($team_members as $member):
			?>
			
			<div class="basis-1/1 md:basis-1/2 lg:basis-1/4 flex justify-center">
				<div 
					class="w-full h-full"
					x-data="{ shown: false }" 
					x-intersect.half="shown = true" 
				>
					<div 
						class="w-full h-full flex flex-col p-4"
						x-show="shown" 
						x-transition:enter="transition ease-out duration-300"
						x-transition:enter-start="opacity-0 scale-50"
						x-transition:enter-end="opacity-100 scale-100"
					>
						<figure class="member-inner">
							<button type="button" class="w-full text-left cursor-pointer bg-transparent border-0 p-0" @click="openModal('<?php echo $member['hash']; ?>')" aria-label="View <?php echo esc_attr($member['name']); ?> profile">
								<?php if ( $member['image'] ) : ?>
									<?php docandtee_responsive_image($member['image'], null, '(min-width: 960px) 20vw, (min-width: 782px) 40vw, 80vw', 'aspect-2/3 w-full object-cover'); ?>
								<?php endif; ?> 
								<figcaption class="member-details text-center">
									<?php if( $member['name'] ) { echo '<h3 class="member-title text-xl mt-3! mb-1">' .esc_html($member['name']). '</h3>'; } ?>
									<?php if( $member['role'] ) { echo '<p class="member-role">' .esc_html($member['role']). '</p>'; } ?>
									<?php if( $member['linkedin'] ) { echo '<a class="mt-2 text-center w-full block" href="' .esc_html($member['linkedin']). '"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="icon-style m-auto transition duration-200 ease-in-out" aria-hidden="true">
                <path d="M196.3 512L103.4 512L103.4 212.9L196.3 212.9L196.3 512zM149.8 172.1C120.1 172.1 96 147.5 96 117.8C96 103.5 101.7 89.9 111.8 79.8C121.9 69.7 135.6 64 149.8 64C164 64 177.7 69.7 187.8 79.8C197.9 89.9 203.6 103.6 203.6 117.8C203.6 147.5 179.5 172.1 149.8 172.1zM543.9 512L451.2 512L451.2 366.4C451.2 331.7 450.5 287.2 402.9 287.2C354.6 287.2 347.2 324.9 347.2 363.9L347.2 512L254.4 512L254.4 212.9L343.5 212.9L343.5 253.7L344.8 253.7C357.2 230.2 387.5 205.4 432.7 205.4C526.7 205.4 544 267.3 544 347.7L544 512L543.9 512z"/>
            </svg></a>'; } ?>
								</figcaption>
							</button>
						</figure>
					</div>
				</div>
			</div>

			<?php endforeach; ?>
			
		</div>
	</div>

	<!-- Team Modal -->
	<div x-show="isOpen" 
		 @keydown.escape.window="closeModal()"
		 class="fixed inset-0 z-100 overflow-y-auto" 
		 style="display: none;"
		 role="dialog"
		 aria-modal="true"
		 aria-labelledby="modal-team-title">
		
		<!-- Backdrop -->
		<div x-show="isOpen"
			 class="fixed inset-0 bg-black opacity-40" 
			 @click="closeModal()" 
			 aria-hidden="true"></div>
		
		<!-- Modal Content -->
		<div class="flex min-h-full items-center justify-center p-4">
			<div x-show="isOpen"
			x-transition:enter="transition ease-out duration-400"
				 x-transition:enter-start="opacity-0 scale-60"
				 x-transition:enter-end="opacity-100 scale-100"
				 x-transition:leave="transition ease-in duration-200"
				 x-transition:leave-start="opacity-100 scale-100"
				 x-transition:leave-end="opacity-0 scale-60"
				 class="relative bg-white shadow-xl max-w-2xl w-full max-h-[90vh] overflow-hidden">
				
				<!-- Modal Header -->
				<div class="flex items-center justify-between p-6 border-b border-gray-200">
					<h3 id="modal-team-title" class="text-xl font-semibold text-gray-900" x-text="currentMember.name"></h3>
					<button type="button" @click="closeModal()" 
							class="hover:primary transition-colors duration-200 cursor-pointer"
							aria-label="Close team member profile">
						<span class="sr-only">Close</span>
						<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
						</svg>
					</button>
				</div>
				
				<!-- Modal Body -->
				<div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
					<h5 class="text-lg font-medium mb-4" x-text="currentMember.role"></h5>
					<div class="mb-12" x-html="currentMember.bio"></div>
					<div x-show="currentMember.image" class="">
						<img :src="currentMember.image" 
							 :alt="currentMember.name" 
							 class="w-full h-auto object-cover">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
function teamModal() {
	return {
		isOpen: false,
		currentMember: {
			name: '',
			role: '',
			bio: '',
			image: ''
		},
		members: {
			<?php 
				// Use the same data collected above
				$member_data = array();
				foreach($team_members as $member) {
					// Properly escape the data for JavaScript
					$name = json_encode($member['name']);
					$role = json_encode($member['role']);
					$bio = json_encode($member['bio']);
					$image_url = $member['image'] ? wp_get_attachment_image_url($member['image'], 'large') : '';
					$image_encoded = json_encode($image_url);
					
					$member_data[] = "'" . $member['hash'] . "': {
						name: " . $name . ",
						role: " . $role . ",
						bio: " . $bio . ",
						image: " . $image_encoded . "
					}";
				}
				echo implode(',', $member_data);
			?>
		},
		
		openModal(memberId) {
			if (this.members[memberId]) {
				this.currentMember = this.members[memberId];
				this.isOpen = true;
				document.body.style.overflow = 'hidden'; // Prevent background scrolling
			}
		},
		
		closeModal() {
			this.isOpen = false;
			document.body.style.overflow = ''; // Restore scrolling
		}
	}
}
</script>

<?php endif; ?>