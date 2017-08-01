<div class="tab-pane fade" id="tab-parents-information">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left">Parents Information</h4>
            <a href="<?php echo site_url('employees/confirmation/edit/parents_information/'.$employee_id); ?>" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-confirmation-parents-information">
                <i class="fa fa-edit"></i> Edit
            </a>
            <div class="modal fade" id="modal-confirmation-parents-information">
                <div class="modal-dialog">
                    <div class="modal-content"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php foreach ($parents_information as $parent_information): ?>
            <?php
                $relationship_id = $parent_information['relationship_id'];
                $index_id = array_search($relationship_id, array_column($relationships, 'id'));
                $relationship = $relationships[$index_id]['name'];
            ?>
            <table class="table table-user-information">
                <thead>
                    <tr>
                        <th colspan="2"><?php echo ucwords(strtolower($relationship)); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>First Name:</td>
                        <td><?php echo $parent_information['first_name']; ?></td>
                    </tr>
                    <tr>
                        <td>Middle Name:</td>
                        <td><?php echo $parent_information['middle_name']; ?></td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td><?php echo $parent_information['last_name']; ?></td>
                    </tr>
                    <tr>
                        <td>Birthdate:</td>
                        <td><?php echo $parent_information['birthdate']; ?></td>
                    </tr>
                    <tr>
                        <td>Birthplace:</td>
                        <td><?php echo $parent_information['birthplace']; ?></td>
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td><?php echo ($parent_information['gender'] == 1) ? 'Male':'Female'; ?></td>
                    </tr>
                </tbody>
            </table>
            <?php endforeach; ?>
        </div>
    </div>
</div>
