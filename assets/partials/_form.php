<?php

$datas = [
    [ 'id' => 'first_name', 'title' => 'First Name', 'type' => 'text' ],
    [ 'id' => 'middle_name', 'title' => 'Middle Name', 'type' => 'text' ],
    [ 'id' => 'last_name', 'title' => 'Last Name', 'type' => 'text' ],
    [ 'id' => 'birthdate_at', 'title' => 'Date of Birth', 'type' => 'date' ],
    [ 'id' => 'gender', 'title' => 'Gender', 'type' => 'select', 'options' => ['Female', 'Male'] ],
    [ 'id' => 'place_of_birth', 'title' => 'Place of Birth (city, state)', 'type' => 'text' ],
    [ 'id' => 'nationality', 'title' => 'Nationality', 'type' => 'text' ],
    [ 'id' => 'email', 'title' => 'Email', 'type' => 'email' ],
    [ 'id' => 'address', 'title' => 'Mail address', 'type' => 'text' ],
    [ 'id' => 'phone_home', 'title' => 'Phone (home)', 'type' => 'text' ],
    [ 'id' => 'phone_work', 'title' => 'Phone (work)', 'type' => 'text' ],
    [ 'id' => 'phone_cell', 'title' => 'Phone (cell)', 'type' => 'text' ],
];

?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>

            <form id="loginForm" action="paypal.php" method="post">
                <input type="hidden" name="product_id" id="productId" />
                <div class="modal-body">

                    <?php foreach (array_chunk($datas, 3) as $dataSet): ?>
                        <div class="row">
                            <?php foreach ($dataSet as $data): ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="<?= $data['id'] ?>" class="control-label"><?= $data['title']; ?></label>
                                        <?php if ($data['type'] == 'select'): ?>
                                            <select name="<?= $data['id']; ?>" class="form-control">
                                                <?php foreach($data['options'] as $option) : ?>
                                                    <option value="<?= $option; ?>"><?= $option; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php else: ?>
                                            <input type="<?= $data['type']; ?>" class="form-control" name="<?= $data['id'] ?>" >
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>

                </div>
                <div class="modal-footer">
                    <input type="image" src="images/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="images/pixel.gif" width="1" height="1">
                </div>
            </form>

        </div>
    </div>
</div>
