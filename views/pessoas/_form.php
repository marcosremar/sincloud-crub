<div class="modal-header">
    <h4 class="modal-title" id="modalLabel">Adicionar Item</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>

</div>

<div class="modal-body">
    <form action="<?php echo $formUrl;?>" id="create-pessoas" method="POST">
        <div class="row">
             <div class="form-group col-md-12">
               <label for="campo1">Nome</label>
               <input type="text" class="form-control" name="nome" value="<?php echo isset($data) ? $data['nome'] : ''?>">
             </div>
         </div>

         <div class="row">
              <div class="form-group col-md-12">
                <label for="campo1">Estado Civil</label>
                <select class="form-control" name="estado_civil_id">
                <?php while ($row = $estadoCivilStmt->fetch()):?>
                    <?php
                        $selected = '';
                        if(isset($data)){
                            $selected = ($data['estado_civil_id'] == $row['id']) ? ' selected' : '';
                        }
                    ?>
                    <option value="<?php echo $row['id']; ?>"<?php echo $selected;?>><?php echo $row['descricao'];?></option>
                <?php endwhile; ?>
                </select>
              </div>
          </div>
          <div class="row">
               <div class="form-group col-md-12">
                    <label for="campo1">Gênero</label>
                <?php while ($row = $generoStmt->fetch()):?>
                    <?php
                        $selected = '';
                        if(isset($data)){
                            $selected = ($data['genero_id'] == $row['id']) ? ' checked="checked"' : '';
                        }
                    ?>
                    <div class="checkbox">
                        <label><input type="radio" name="genero_id" value="<?php echo $row['id']; ?>"<?php echo $selected; ?>> <?php echo $row['descricao']; ?></label>
                    </div>
                <?php endwhile; ?>
               </div>
           </div>
      <!-- area de campos do form -->
    </form>
</div>

<div class="modal-footer">
    <a href="index.html" class="btn btn-default" data-dismiss="modal">Cancelar</a>
    <button type="button" onclick="$('#create-pessoas').submit();"class="btn btn-primary">Salvar</button>
</div>
