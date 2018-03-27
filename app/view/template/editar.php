  <div class="row">
    <div class="col-lg-6 col-lg-offset-3">
      <form method="POST" action="<?php echo $conteudo['form_action']; ?>">
             <input type="hidden" name="id" value="<?php echo $conteudo['id_hidden'];?>">
             <?php
              foreach ($conteudo['form'] as $key => $value) {
             ?>
               <div class="form-group">
                  <label ><?php echo $value['label']; ?></label>
                  <input type="<?php echo $value['type']; ?>"
                    class="form-control" 
                    name="<?php echo $value['name']; ?>" 
                    placeholder="<?php echo $value['label']; ?>"
                    value="<?php echo $value['value']; ?>"
                    >
               </div>
             <?php
              }
             ?>
             <?php if(isset($conteudo['form_select'])){
                 foreach ($conteudo['form_select'] as $k => $v) {
                 $name = $v['name'];
              ?>
                  <div class="form-group">
                    <label><?php echo $v['label']; ?></label>
                    <select class="form-control" name="<?php echo $v['name']; ?>">
                      <?php foreach ($v['rs'] as $key => $value) { ?>  
                        
                        <option value="<?php echo $value['id'];?>"  <?php echo ($value['id'] == $v['select'])? 'selected':  ''; ?> > 
                          <?php echo $value[$name];?> 
                        </option>

                      <?php } ?>
                    </select>
                  </div>
             <?php }} ?>
             <button type="submit" class="btn btn-primary">Atualizar</button>       
      </form>
    </div>
  </div>