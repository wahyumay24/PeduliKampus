<?php
						if (!empty($modBatch)){
						    foreach($modBatch as $data) {
					?>
                    <tr>
                        <td><?php echo $data->batch_name; ?></td>
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
                            <a class="btn btn-circle btn-warning btn-sm" onClick="SettingForm('Edit', <?php echo $data->id; ?>, '<?php echo $data->batch_name; ?>', '<?php echo $data->is_active; ?>')"><i class="fas fa-pen"></i></a>
                            <a class="btn btn-circle btn-danger btn-sm" onClick='DeleteBatch(<?php echo $data->id; ?>)'><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
					<?php
						    }
						}
					?>