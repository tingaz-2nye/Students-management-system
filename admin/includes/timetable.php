<?php 
    require_once ('../../config/database.php');
    require_once ('functions.php');

    $stmt = $db->prepare("SELECT * FROM timetable");
    $stmt->execute();
    $count = 1;

    
    
   echo ' <table id="dataTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Day of Week</th>
                                            <th>Class</th>
                                            <th>Subject</th>
                                            <th>Start time</th>
                                            <th>End time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                        
                                        
                                        while($row = $stmt->fetch()){
                                        echo'
                                        <tr>
                                            <td>'.$count.'</td>
                                            <td>'. $row['day'].'</td>
                                            <td>'. $row['class_code'].'</td>
                                            <td>'. $row['subject_code'].'</td>
                                            <td>'. $row['time_start'].'</td>
                                            <td>'. $row['time_end'].'</td>
                                            <td>
                                                <button class="btn btn-xs btn-info" data-id="'. $row['id'].'" data-toggle="modal" data-target="#editTimetable">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button class="timetable_delete btn btn-xs btn-danger" data-id="'. $row['id'].'">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </td>
                                        </tr>';
                                         $count = $count+1; } 
                                  echo'  </tbody>
                                </table>';
?>