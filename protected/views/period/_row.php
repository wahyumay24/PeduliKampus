<?php
						if (!empty($modPeriod)){
						    foreach($modPeriod as $data) {
					?>
                    <tr>
                        <td><?php echo $data->period_name; ?></td>
                        <td><?php echo $data->start_date; ?></td>
                        <td><?php echo $data->end_date; ?></td>
                        <td><?php echo $data->description; ?></td>
                        <td>
                            <?php 
                                if ($data->is_active){ 
                                    echo "<i class='badge badge-success'>Active</i>";
                                } else { 
                                    echo "<i class='badge badge-danger'>Non Active</i>";
                                } 
                            ?>
                        </td>
                        <td>
                            <a class="btn btn-circle btn-warning btn-sm" 
                                onClick="SettingForm(
                                    'EditPeriod', 
                                    <?php echo $data->id; ?>, 
                                    '<?php echo $data->period_name; ?>', 
                                    '<?php echo $data->is_active; ?>', 
                                    '<?php echo $data->description; ?>',
                                    '<?php echo $data->start_date; ?>',
                                    '<?php echo $data->end_date; ?>'
                                )">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a class="btn btn-circle btn-danger btn-sm" onClick='DeletePeriod(<?php echo $data->id; ?>)'><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
					<?php
						    }
						}
					?>