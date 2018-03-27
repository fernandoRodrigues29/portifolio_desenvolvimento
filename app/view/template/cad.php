   <div class="row">
     <!-- <div class="well well-lg">Large Well</div>-->
      <?php 
        if(isset($_SESSION['msg'])){
          $msg = $_SESSION['msg'];
        ?>
       <div class="col-lg-6 col-lg-offset-3"> 
         <div class="alert alert-info">
            <strong><?php echo $msg; ?></strong> 
         </div>
       </div>
       <?php
          unset($_SESSION['msg']);
          } 
        ?>
   </div>
   <div class="row">

    <div class="col-lg-6 col-lg-offset-3">
      <form method="POST" action="<?php echo $conteudo['form_action']; ?>">
             <?php
              foreach ($conteudo['form'] as $key => $value) {
             ?>
               <div class="form-group">
                  <label ><?php echo $value['label']; ?></label>
                  <input type="<?php echo $value['type']; ?>"
                    class="form-control <?php echo $value['class']; ?>" 
                    name="<?php echo $value['name']; ?>" 
                    placeholder="<?php echo $value['label']; ?>"
                    value="<?php echo $value['value']; ?>"
                    <?php echo (isset($value['ml']))? 'maxlength="10"' : '';?>
                    >
               </div>
             <?php
              }
              if(isset($conteudo['form_select'])){
              foreach ($conteudo['form_select'] as $k => $v) {
                $name = $v['name'];
             ?>

                <div class="form-group">
                  <label><?php echo $v['label']; ?></label>
                  <select class="form-control" name="<?php echo $v['name']; ?>">
                    <?php foreach ($v['rs'] as $key => $value) { ?>  
                      <option value="<?php echo $value['id'];?>"> <?php echo $value[$name];?> </option>
                    <?php } ?>
                  </select>
                </div>
             <?php }
                    } ?>
             <button type="submit" class="btn btn-primary">Submit</button>       
      </form>
    </div>
  </div>