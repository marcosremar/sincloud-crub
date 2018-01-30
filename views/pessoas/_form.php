<div class="modal-body">
    <form action="<?php echo $formUrl;?>" id="create-pessoas" method="POST">
        <input type="hidden" name="endereco_id" value="<?php echo isset($data) ? $data['endereco_id'] : ''?>">
        <div class="row">
             <div class="form-group col-md-12">
               <label for="nome">Nome</label>
               <input type="text" class="form-control" name="nome" value="<?php echo isset($data) ? $data['nome'] : ''?>" required>
             </div>
         </div>
         <div class="row">
             <div class="form-group col-md-2">
               <label for="idade">Idade</label>
               <input type="number" class="form-control" name="idade" value="<?php echo isset($data) ? $data['idade'] : ''?>" required>
             </div>
             <div class="form-group col-md-4">
               <label for="telefone">Telefone</label>
               <input type="number" class="form-control" min="1" max="9999999999" name="telefone" value="<?php echo isset($data) ? $data['telefone'] : ''?>" required>
             </div>
             <div class="form-group col-md-4">
               <label for="pretensao_salarial">Pretensão Salarial</label>
               <input type="number" class="form-control" max="6" name="pretensao_salarial" value="<?php echo isset($data) ? $data['pretensao_salarial'] : ''?>" required>
             </div>
         </div>
         <div class="row">
              <div class="form-group col-md-8">
                <label for="formacao_academica_id">Formação Academica</label>
                <select class="form-control" name="formacao_academica_id" required>
                <?php while ($row = $formacaoAcademicaStmt->fetch()):?>
                    <?php
                        $selected = '';
                        if(isset($data)){
                            $selected = ($data['formacao_academica_id'] == $row['id']) ? ' selected' : '';
                        }
                    ?>
                    <option value="<?php echo $row['id']; ?>"<?php echo $selected;?>><?php echo $row['descricao'];?></option>
                <?php endwhile; ?>
                </select>
              </div>
          </div>
          <fieldset>
            <legend>Endereço</legend>
          <div class="row">
             <div class="form-group col-md-3">
               <label for="cep">CEP</label>
               <input type="text" class="form-control" name="cep" value="<?php echo isset($data) ? $data['cep'] : ''?>" required>
             </div>
         </div>
         <div class="row">
             <div class="form-group col-md-4">
               <label for="cep">Logradouro</label>
               <input type="text" class="form-control" name="logradouro" value="<?php echo isset($data) ? $data['logradouro'] : ''?>" readonly>
             </div>
             <div class="form-group col-md-3">
               <label for="complemento">Complemento</label>
               <input type="text" class="form-control" name="complemento" value="<?php echo isset($data) ? $data['complemento'] : ''?>">
             </div>
             <div class="form-group col-md-3">
               <label for="bairro">Bairro</label>
               <input type="text" class="form-control" name="bairro" value="<?php echo isset($data) ? $data['bairro'] : ''?>" readonly>
             </div>
         </div>
         <div class="row">  
             <div class="form-group col-md-3">
               <label for="localidade">Cidade</label>
               <input type="text" class="form-control" name="localidade" value="<?php echo isset($data) ? $data['localidade'] : ''?>" readonly>
             </div>
             <div class="form-group col-md-3">
               <label for="uf">UF</label>
               <input type="text" class="form-control" name="uf" value="<?php echo isset($data) ? $data['uf'] : ''?>" readonly>
             </div>
         </div>
         </fieldset>
         
      <!-- area de campos do form -->
    </form>
</div>

<div class="modal-footer">
    <a href="index.html" class="btn btn-default" data-dismiss="modal">Cancelar</a>
    <button type="button" onclick="btnSaveModal();"class="btn btn-primary">Salvar</button>
</div>
