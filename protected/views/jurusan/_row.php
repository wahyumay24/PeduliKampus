<?php
						if (!empty($modJurusan)){
						    foreach($modJurusan as $data) {
					?>
                    <tr>
                        <td><?php echo $data->kode; ?></td>
                        <td><?php echo $data->nama; ?></td>
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
                            <a class="btn btn-circle btn-warning btn-sm" onClick="SettingForm('Edit', <?php echo $data->id; ?>, '<?php echo $data->kode; ?>', '<?php echo $data->nama; ?>', '<?php echo $data->is_active; ?>')"><i class="fas fa-pen"></i></a>
                            <a class="btn btn-circle btn-danger btn-sm" onClick='Delete(<?php echo $data->id; ?>)'><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
					<?php
						    }
						}
					?>