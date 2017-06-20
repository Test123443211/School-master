<?php
$student_info = $this->db->get_where('enroll', array(
            'student_id' => $param2, 'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description
        ))->result_array();
foreach ($student_info as $row):
    ?>

    <div class="profile-env">

        <header class="row">

            <div class="col-sm-3">

                <a href="#" class="profile-picture">
                    <img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" 
                         class="img-responsive img-circle" />
                </a>

            </div>

            <div class="col-sm-9">

                <ul class="profile-info-sections">
                    <li style="padding:0px; margin:0px;">
                        <div class="profile-name">
                            <h3>
                                <?php echo $this->db->get_where('student', array('student_id' => $param2))->row()->name; ?>                     
                            </h3>
                        </div>
                    </li>
                </ul>

            </div>


        </header>

        <section class="profile-info-tabs"  style="background-color: inherit">

            <div class="row">

                <div class="">
                    <br>
                    <table class="table table-bordered table-striped  table-condensed">

                        <tr>
                            <td><?php echo get_phrase('admission_date'); ?></td>
                            <td><b><?php echo date("d-M-Y", strtotime($this->db->get_where('student', array('student_id' => $row['student_id']))->row()->admission_date)); ?></b></td>

                            <td><?php echo get_phrase('admit_class'); ?></td>
                            <td><b><?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->admit_class; ?></b></td>

                        </tr>

                        <?php if ($row['class_id'] != ''): ?>


                            <tr>
                                <td><?php echo get_phrase('class'); ?></td>
                                <td><b><?php echo $this->crud_model->get_class_name($row['class_id']); ?></b></td>


                                <?php if ($row['section_id'] != '' && $row['section_id'] != 0): ?>

                                    <td><?php echo get_phrase('section'); ?></td>
                                    <td><b><?php echo $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name; ?></b></td>

                                <?php endif; ?>

                            </tr>


                        <?php endif; ?>



                        <?php if ($row['roll'] != ''): ?>
                            <tr>
                                <td><?php echo get_phrase('roll'); ?></td>
                                <td><b><?php echo $row['roll']; ?></b></td>

                                <td><?php echo get_phrase('gender'); ?></td>
                                <td><b><?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->sex; ?></b></td>

                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td><?php echo get_phrase('birthday'); ?></td>
                            <td colspan="3"><b>
                                    <?php echo date("d-M-Y", strtotime($this->db->get_where('student', array('student_id' => $row['student_id']))->row()->birthday)); ?>
                                </b>
                                (
                                <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->dob_in_words; ?>
                                )
                            </td>
                        </tr>


                        <tr>

                            <td><?php echo get_phrase('email'); ?></td>
                            <td><b><?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->email; ?></b></td>
                            <td><?php echo get_phrase('phone'); ?></td>
                            <td><b><?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->phone; ?></b></td>


                        </tr>
                        <tr>
                            <td><?php echo get_phrase('address'); ?></td>
                            <td colspan="3" ><b><?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->address; ?></b>
                            </td>

                        </tr>

                        <tr>
                            <td colspan="4" style="text-align: center"> 
                                <h3>
                                    Parent Data
                                </h3></td>
                        </tr>
                        <tr>
                            <td><?php echo get_phrase('parent'); ?></td>
                            <td>
                                <b>
                                    <?php
                                    $parent_id = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->parent_id;
                                    echo $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->name;
                                    ?>
                                </b>
                            </td>
                            <td><?php echo get_phrase('parent_phone'); ?></td>
                            <td><b><?php echo $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->phone; ?></b></td>
                        </tr>
                        <tr>
                            <td><?php echo get_phrase('profession'); ?></td>
                            <td>
                                <b><?php echo $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->profession; ?> </b>
                            </td>
                            <td><?php echo get_phrase('email'); ?></td>
                            <td><b><?php echo $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->email; ?></b></td>
                        </tr>
                        <tr>
                            <td><?php echo get_phrase('address'); ?></td>
                            <td colspan="3">
                                <b><?php echo $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->address; ?> </b>
                            </td>
                        </tr>


                        <?php
                        if ($this->db->get_where('student', array('student_id' => $row['student_id']))->row()->status == 0) {
                            ?>
                            <tr>
                                <td colspan="4"  style="text-align: center">   <h3>Withdraw Info  </h3></td>
                            </tr>
                            <tr>
                                <td> <?php echo get_phrase('Withdraw Date'); ?> </td>
                                <td>  <?php echo date("d-M-Y", strtotime($this->db->get_where('student_withdraw', array('student_id' => $row['student_id'], 'reg_no' => $row['roll']))->row()->withdraw_date)) ?></td>
                                <td> <?php echo get_phrase('withdraw_class'); ?> </td>
                                <td>  
                                    <?php
                                    $withdraw_class = $this->db->get_where('student_withdraw', array('student_id' => $row['student_id'], 'reg_no' => $row['roll']))->row()->withdraw_class;
                                    echo $this->crud_model->get_class_name($withdraw_class);
                                    ?>
                                </td>

                            </tr>

                            <tr>
                                <td> <?php echo get_phrase('reason'); ?> </td>
                                <td>  <?php echo $this->db->get_where('student_withdraw', array('student_id' => $row['student_id'], 'reg_no' => $row['roll']))->row()->reason ?></td>
                                <td> <?php echo get_phrase('dues'); ?> </td>
                                <td>  <?php echo $this->db->get_where('student_withdraw', array('student_id' => $row['student_id'], 'reg_no' => $row['roll']))->row()->dues ?></td>             
                            </tr>

                            <tr>
                                <td> <?php echo get_phrase('prepared_by'); ?> </td>
                                <td>  <?php echo $this->db->get_where('student_withdraw', array('student_id' => $row['student_id'], 'reg_no' => $row['roll']))->row()->prepared_by ?></td>
                                <td> <?php echo get_phrase('check_by'); ?> </td>
                                <td>  <?php echo $this->db->get_where('student_withdraw', array('student_id' => $row['student_id'], 'reg_no' => $row['roll']))->row()->check_by ?></td>             
                            </tr>
                              <tr>
                                 <td> <?php echo get_phrase('remarks'); ?> </td>
                                 <td colspan="3">  <?php echo $this->db->get_where('student_withdraw', array('student_id' => $row['student_id'], 'reg_no' => $row['roll']))->row()->remarks ?></td>             
                            </tr>
                            <?php
                        }
                        ?>



                    </table>
                </div>
            </div>		
        </section>



    </div>


<?php endforeach; ?>