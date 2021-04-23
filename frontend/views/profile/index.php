<?php
/** @var \common\models\User $user*/
/** @var \yii\web\View  $this*/
 /** @var \common\models\UserAddress $userAddresses*/

 use yii\helpers\Html;
 use yii\bootstrap4\ActiveForm;
  use \yii\widgets\Pjax;
 ?>

 <div class="row">
   <div class="col">
     <div class="card">
       <div class="card-header">
          Address Information
       </div>
       <div class="card-body">
      <?php Pjax::begin([
        'enablePushState' => false
        ]) ?>
         <?php echo $this->render('user_address', [
           'userAddress' => $userAddress
           ]) ?>
            <?php Pjax::end() ?>
    </div>
  </div>
   </div>
   <div class="col">
     <div class="card">
       <div class="card-header ">
          Account Information
       </div>
       <div class="card-body ">
      <?php Pjax::begin([
        'enablePushState' => false
        ]) ?>
         <?php echo $this->render('user_account',[
           'user' =>$user
           ]) ?>
            <?php Pjax::end() ?>
       </div>
     </div>
   </div>
</div>
