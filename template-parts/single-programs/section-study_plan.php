<?php
$program_post_id      = get_the_id();
$study_plan           = get_field( 'study_plan_section', $program_post_id );
?>
<?php if ( $study_plan ) :
	$main_title = $study_plan['main_title'];
	$description      = $study_plan['description'];
	$total_ects       = $study_plan['total_ects'];
	$elective_modules = $study_plan['elective_modules'];
	?>
    <section id="study_plan" class="study_plan_section py-3 section_sub_menu">

        <div class="study_plan_header">
            <div class="container">
                <h2 class="section_title text-center mb-5">
					<?php echo $main_title; ?><?php echo get_the_title(); ?>
                </h2>
                <div class="description text-center">
					<?php echo $description; ?>
                </div>
            </div>
        </div>
        <div class="summary_credits">
            <div class="container">
				<?php if ( $total_ects ) :
					$total_ects_title = $total_ects['total_ects_title'];
					$total_ects_list = $total_ects['total_ects_list'];
					$study_plan_list = $total_ects['study_plan_list'];
					?>
                    <div class="wrapper_ects">
                        <div class="total_ects">
                            <h3 class="text-center mb-5">
								<?php echo $total_ects_title; ?>
                            </h3>
							<?php if ( $total_ects_list ) : ?>
                                <div class="total_ects_list mb-5">
                                    <div class="row">
										<?php foreach ( $total_ects_list as $item ) : ?>
                                            <div class="col-md-6 col-xl-3">
												<?php echo $item['title_ects']; ?>
                                                <strong><?php echo $item['total_ects']; ?></strong>
                                            </div>
										<?php endforeach; ?>
                                    </div>
                                </div>
							<?php endif; ?>
                        </div>
						<?php if ( $study_plan_list ) : ?>
                            <div class="study_plan_list mb-5">
                                <div class="row">
                                    <!--                            year-->
									<?php foreach ( $study_plan_list as $key => $year ) : ?>
<!--                                        <div class="d-flex mb-3 w-100">-->
<!--                                            <div class="item_year">-->
                                                <!--                                    semester-->
												<?php foreach ( $year['semesters'] as $number => $semester ) : ?>
                                                    <div class="item_semester col-md-6 col-xl-3 mb-3">
                                                        <div class="item_semester_header">
                                                            <div class="item_semester_header_wrapper">
                                                                <div class="row">
                                                                    <div class="col-9 col_item">
                                                                        <div class="long_arrow"></div>
																		<?php if ( $key >= 0 && $key <= 4 ) {
																			$semester_count = $key + 1;
																		} ?>
                                                                        <div>
                                                                            <strong><?php echo _e( 'Semester', 'MUDT' ); ?>
																				<?php echo $key + $number + $semester_count; ?>
                                                                                : </strong><br>
																			<?php echo $semester['semester_title']; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3 col_item"
                                                                         style="display: flex;flex-direction: column; align-items: center; justify-content: center;">
                                                                        <strong><?php echo $semester['semester_ects']; ?></strong>
																		<?php echo _e( ' ECTS', 'MUDT' ); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item_semester_content_wrapper">
                                                            <div class="item_semester_content">
																<?php echo $semester['semester_content']; ?>
                                                            </div>
                                                        </div>
                                                    </div>
												<?php endforeach; ?>
<!--                                            </div>-->
<!--                                        </div>-->
									<?php endforeach; ?>
                                </div>
                            </div>
						<?php endif; ?>
                    </div>
				<?php endif; ?>
            </div>
        </div>


		<?php if ( $elective_modules ) :
			$left_col = $elective_modules['elective_modules_left_col'];
			$center_col = $elective_modules['elective_modules_center'];
			$right_col = $elective_modules['elective_modules_right_col'];
			?>
            <div class="elective_courses mb-5">
                <div class="container">
                    <div class="elective_modules_wrapper">
                        <div class="elective_modules_title text-center mb-5">
							<?php echo $elective_modules['elective_modules_title']; ?>
                        </div>
                        <div class="elective_modules">
                            <div class="row justify-content-center">
								<?php if ( $left_col ) : ?>
                                    <div class="col-md-6 col-xl-4">
										<?php echo $left_col; ?>
                                    </div>
								<?php endif; ?>
								<?php if ( $center_col ) : ?>
                                    <div class="col-md-6 col-xl-4">
										<?php echo $center_col; ?>
                                    </div>
								<?php endif; ?>
								<?php if ( $right_col ) : ?>
                                    <div class="col-md-6 col-xl-4">
										<?php echo $right_col; ?>
                                    </div>
								<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="elective_modules_title text-center mb-5">
					<?php echo $elective_modules['elective_modules_details']; ?>
                </div>
            </div>

		<?php endif; ?>


    </section>

<?php endif; ?>