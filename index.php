<?php 
    include ('header.php');
?>
<?php 
    include ('bd_agenda.php');
?>


<div>
    <h2>contatos Cadastrados</h2>
    <table>
        <thead>
            <tr>
                <th>Títulos</th>
                <th>Descrição</th>
                <th>Ano</th>
                <th>Preço</th>
                <th>Disponível</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                if(false) {

                }else{
                    echo "<p>Nenhum filme cadastrado.</p>";
                }
            ?>
        </tbody>
    </table>
</div>


<?php 
    include('footer.php');
?>