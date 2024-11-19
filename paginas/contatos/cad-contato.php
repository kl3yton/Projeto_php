<div class="d-flex flex-column justify-content-center align-items-center min-vh-100">

    <h3 class=" mt-3 bi bi-person-square">Cadastro de Contato</h3>

    <form class="col-12 col-md-8 col-lg-6 needs-validation" action="index.php?menuop=inserir-contato" method="post" novalidate>
    
        <div class="col-md-12">
            <label class="form-label" for="nomeContato">Nome</label>
            <div class="input-group has-validation">
                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                <input class="form-control" type="text" name="nomeContato" id="nomeContato" required>
                <div class="valid-feedback">Está tudo correto, prossiga!</div>
                <div class="invalid-feedback">Campo obrigatório de no máximo 255 caracteres!</div>
            </div>
        </div>
    
        <div class="col-md-12">
            <label class="form-label" for="emailContato">E-mail</label>
            <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input class="form-control" type="text" name="emailContato" id="emailContato" required>
                <div class="valid-feedback">Está tudo correto, prossiga!</div>
                <div class="invalid-feedback">Por favor digite o e-mail válido!</div>
            </div>
        </div>
    
        <div class="col-md-12">
            <label class="form-label" for="telefoneContato">Telefone</label>
            <div class="input-group has-validation">
                <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                <input class="form-control" type="text" name="telefoneContato" id="telefoneContato" required>
                <div class="valid-feedback">Está tudo correto, prossiga!</div>
                <div class="invalid-feedback">Por favor digite um número correto!</div>
            </div>
        </div>
    
        <div class="col-md-12">
            <label class="form-label" for="enderecoContato">Endereço</label>
            <div class="input-group has-validation">
                <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
                <input class="form-control" type="text" name="enderecoContato" id="enderecoContato" required>
                <div class="valid-feedback">Está tudo correto, prossiga!</div>
                <div class="invalid-feedback">Por favor digite o endereço correto!</div>
            </div>
        </div>
    
        <div class="col-md-12">
            <label class="form-label" for="data_nasc_Contato">Data de Nascimento</label>
            <div class="input-group has-validation">
                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                <input class="form-control" type="date" name="data_nasc_Contato" id="data_nasc_Contato" required>
                <div class="valid-feedback">Está tudo correto, prossiga!</div>
                <div class="invalid-feedback">Digite uma idade válida!</div>
            </div>
        </div>
    
        <div class="col-12 mt-3">
            <input class="btn btn-success w-100" type="submit" value="Adicionar" name="btnadicionar">
        </div>
    </form>
</div>
