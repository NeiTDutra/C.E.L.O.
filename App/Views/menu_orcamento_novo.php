
<br/>
<fieldset class="f_fds"><legend>Designação</legend>

    <label for="id_orc">Orçamento nº:</label> 
    <input type="text" 
           name="id_orc" 
           id="id_orc" 
           size="8" 
           value="<?php echo isset($_SESSION['n_orc']) ? $_SESSION['n_orc'] : NULL; ?>"
           >

    <input type="hidden" 
           name="id_cli" 
           value="<?php echo isset($_SESSION['cod_cli']) ? $_SESSION['cod_cli'] : null; ?>"
           >

    <label for="nome_cli">Cliente:</label> 
    <input type="text" 
           name="nome_cli" 
           id="nome_cli" 
           size="20" 
           value="<?php echo isset($_SESSION['n_cli']) ? $_SESSION['n_cli'] : null; ?>"
           >

    <input type="submit" name="p_cli" value="...">

    <label for="fone_cli">Fone:</label> 
    <input type="text" 
           name="fone_cli" 
           id="fone_cli" 
           size="13" 
           onKeyUp="mascara(this, '## #####-####');" 
           maxlength= "13" 
           title="Formato: 00 00000-0000" 
           value="<?php echo isset($_SESSION['f_cli']) ? $_SESSION['f_cli'] : null; ?>"
           >

</fieldset>
<br/>
                        
                        
