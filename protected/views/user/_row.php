<?php
						if (!empty($modUser)){
						    foreach($modUser as $data) {
					?>
                    <tr>
                        <td><?php echo $data->no_identitas; ?></td>
                        <td><?php echo $data->nama; ?></td>
                        <td><?php echo $data->jurusan->nama ?? ''; ?></td>
                        <td><?php echo $data->angkatan->nama ?? ''; ?></td>
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
                            <a class="btn btn-circle btn-warning btn-sm" onClick="SettingForm('EditUser', <?php echo $data->id; ?>, '<?php echo $data->jurusan->nama; ?>', '<?php echo $data->is_active; ?>')"><i class="fas fa-pen"></i></a>
                            <a class="btn btn-circle btn-danger btn-sm" onClick='DeleteUser(<?php echo $data->id; ?>)'><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
					<?php
						    }
						}
					?>