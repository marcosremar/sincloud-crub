<div id="top" class="row top-buffer">
    <div class="col-md-4">
        <h3>Lista de Pessoas</h3>
    </div>

    <div class="col-md-4">
        <form method='POST' action="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>">
            <div class="input-group h2">
                 <input name="search" class="form-control" id="search" type="text" placeholder="Pesquisar...">
                 <span class="input-group-btn">
                         <button class="btn btn-primary" type="submit">
                             <i class="fa fa-fw" aria-hidden="true" title="Copy to use search"></i>
                         </button>
                 </span>
             </div>
         </form>
    </div>
    <div class="col-md-4">
        <a href="index.php?controller=pessoas&action=create" data-target="#default-modal" data-toggle="modal" class="btn btn-primary pull-right h2">Novo Item</a>
    </div>
</div> <!-- /#top -->

<table class="table table-striped table-hover top-buffer">
  <thead>
    <tr>
      <!-- <th>#</th> -->
      <th>Nome</th>
      <th>Telefone</th>
      <th>Estado</th>
      <th>Cidade</th>
      <th>Formação Academica</th>
      <th>Pretensão Salarial</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
<?php while ($row = $pessoasList->fetch()):?>
    <tr>
      <!-- <th scope="row"><?php echo $row['id'] ?></th> -->
      <td><?php echo $row['nome'];?></td>
      <td><?php echo $row['telefone'];?></td>
      <td><?php echo $row['uf'];?></td>
      <td><?php echo $row['localidade'];?></td>
      <td><?php echo $row['formacao_academica_descricao'];?></td>
      <td><?php echo $row['pretensao_salarial'];?></td>
      <td class="actions">
          <button type="button" class="btn btn-sm btn-danger" onclick="excluirItem(<?php echo $row['id'] ?>);">
              <i class="fa fa-trash-o" aria-hidden="true"></i>
          </button>
          <button type="button" class="btn btn-sm btn-primary" href="index.php?controller=pessoas&action=edit&id=<?php echo $row['id'] ?>" data-target="#default-modal" data-toggle="modal">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          </button>
      </td>
    </tr>
<?php endwhile;?>
  </tbody>
</table>

<!-- Default Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          Remover Item
      </div>
      <div class="modal-body">
          Deseja Realmente excluir esse item?
          <form action="index.php?controller=pessoas&action=destroy" method="POST" id="form-delete-item">
              <input name="id" type="hidden" value="">
          </form>
      </div>
      <div class="modal-footer">
          <a href="index.html" class="btn btn-default" data-dismiss="modal">Cancelar</a>
          <button type="button" onclick="$('#form-delete-item').submit();"class="btn btn-primary" id="excluirItem">Excluir</button>
      </div>
    </div>
  </div>
</div> <!-- /.modal -->


<ul class="pagination pagination-lg justify-content-end">
    <?php if ($paginator->getPrevUrl()): ?>
        <li class="page-item"><a class="page-link" href="<?php echo $paginator->getPrevUrl(); ?>">&laquo; Anterior</a></li>
    <?php endif; ?>

    <?php foreach ($paginator->getPages() as $page): ?>
        <?php if ($page['url']): ?>
            <li class="page-item <?php echo $page['isCurrent'] ? 'active' : ''; ?>">
                <a class="page-link" href="<?php echo $page['url']; ?>"><?php echo $page['num']; ?></a>
            </li>
        <?php else: ?>
            <li class="page-item disabled"><span><?php echo $page['num']; ?></span></li>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if ($paginator->getNextUrl()): ?>
        <li class="page-item"><a class="page-link" href="<?php echo $paginator->getNextUrl(); ?>">Próximo &raquo;</a></li>
    <?php endif; ?>
</ul>

<script>

$(function(){

  $('#default-modal').on('shown.bs.modal', function(){
    console.log('herere');
    // add search address functionaly
    $("[name=cep]").on('change', function(){ console.log('dssdds');
        var cep = $(this).val();
        $.getJSON( "http://viacep.com.br/ws/"+cep+"/json/", function( data ) {
            $("[name=logradouro]").val(data.logradouro);
            $("[name=complemento]").val(data.complemento);
            $("[name=bairro]").val(data.bairro);
            $("[name=localidade]").val(data.localidade);
            $("[name=uf]").val(data.uf);
        });
    });
  });

});

function btnSaveModal()
{
    // Validation
        var errors = 0;
        // nome
        var $nome = $('#create-pessoas [name^=nome]');
        if($($nome).val())
          $($nome).css('border', '1px solid #ccc');
        else{
          $($nome).css('border', '1px solid #FF0000');
          ++errors;
        }

        // idade
        var $idade = $('#create-pessoas [name^=idade]');
        if($($idade).val())
          $($idade).css('border', '1px solid #ccc');
        else{
          $($idade).css('border', '1px solid #FF0000');
          ++errors;
        }
        // telefone
        var $telefone = $('#create-pessoas [name^=telefone]');
        if($($telefone).val())
          $($telefone).css('border', '1px solid #ccc');
        else{
          $($telefone).css('border', '1px solid #FF0000');
          ++errors;
        }
        // pretensao salarial
        var $pretensao_salarial = $('#create-pessoas [name^=pretensao_salarial]');
        if($($pretensao_salarial).val())
          $($pretensao_salarial).css('border', '1px solid #ccc');
        else{
          $($pretensao_salarial).css('border', '1px solid #FF0000');
          ++errors;
        }
        // formacao academica
        var $formacao_academica_id = $('#create-pessoas [name^=formacao_academica_id] option:selected');
        if($($formacao_academica_id).val())
          $($formacao_academica_id).css('border', '1px solid #ccc');
        else{
          $($formacao_academica_id).css('border', '1px solid #FF0000');
          ++errors;
        }
        // cep
        var $cep = $('#create-pessoas [name^=cep]');
        if($($cep).val())
          $($cep).css('border', '1px solid #ccc');
        else{
          $($cep).css('border', '1px solid #FF0000');
          ++errors;
        }
        if(! errors){
          $("#create-pessoas").submit();
        }
  }
</script>

<script>
    function excluirItem(id){
        $('#form-delete-item [name=id]').val(id);
        $('#delete-modal').modal();
    }
</script>
