<?php

$datas = [
    [ 'id' => 'first_name', 'title' => 'First Name', 'type' => 'text' ],
    [ 'id' => 'middle_name', 'title' => 'Middle Name', 'type' => 'text' ],
    [ 'id' => 'last_name', 'title' => 'Last Name', 'type' => 'text' ],
    [ 'id' => 'birthdate_at', 'title' => 'Date of Birth', 'type' => 'date' ],
    [ 'id' => 'checkin_at', 'title' => 'Check-in', 'type' => 'date' ],
    [ 'id' => 'gender', 'title' => 'Gender', 'type' => 'select', 'options' => ['Female', 'Male'] ],
    [ 'id' => 'nationality', 'title' => 'Nationality', 'type' => 'text' ],
    [ 'id' => 'email', 'title' => 'Email', 'type' => 'email' ],
    [ 'id' => 'phone_home', 'title' => 'Phone (home)', 'type' => 'text' ],
    [ 'id' => 'phone_cell', 'title' => 'Phone (cell)', 'type' => 'text' ],
    [ 'id' => 'address', 'title' => 'Mailing address', 'type' => 'text', 'col' => 12 ],
];

?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>

            <form class="form-horizontal" id="contactform" name="commentform" method="post" action="paypal.php">
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="productId" />
                    <?php foreach($datas as $data): ?>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="<?= $data['id']; ?>"><?= $data['title']; ?></label>
                        <div class="col-md-6">
                            <?php if ($data['type'] == 'select'): ?>
                                <select class="form-control" name="<?= $data['id']; ?>" id="<?= $data['id']; ?>">
                                    <?php foreach($data['options'] as $option): ?>
                                        <option value="<?= $option; ?>"><?= $option; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <?php else: ?>
                            <input type="<?= $data['type']; ?>" class="form-control" id="<?= $data['id']; ?>" name="<?= $data['id']; ?>" placeholder="<?= $data['title']; ?>"/>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" value="Submit" class="btn btn-primary pull-right" id="send_btn">Buy Now</button>
                    <!--<input type="image" src="images/btn_buynowCC_LG.gif" border="0" id="send_btn" name="submit" alt="PayPal - The safer, easier way to pay online!">-->
                    <!--<input type="image" src="images/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">-->
                    <!--<img alt="" border="0" src="images/pixel.gif" width="1" height="1">-->
                </div>
            </form>

        </div>
    </div>
</div>
