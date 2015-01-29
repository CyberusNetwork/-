    <!-- Macro -->
    <div class="panel panel-default">
    	<div class="panel-heading" role="tab" id="headingTwo">
    		<h4 class="panel-title">
    			<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
    				<b>Macros</b>
    			</a>
    		</h4>
    	</div>
    	<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
    		<div class="panel-body">
    			<!-- macro content-->
    			<!-- macro Table -->
    			<div class="panel panel-default">
    				<div class="panel-heading" role="tab" id="headingTwo">
    					<h4 class="panel-title">
    						<a class="collapsed" data-toggle="collapse" href="#collapseTree" aria-expanded="false" aria-controls="collapseTree">
    							<b>Liste des Macros</b>
    						</a>
    					</h4>
    				</div>
    				<div id="collapseTree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
    					<table id="Macro_Table" class="table">
    						<thead>
    							<tr>
                                    <th>Actions</th>
                                    <th>Nom de la Macro</th>
                                    <th>Fonction de la Macro</th>
                                </tr>
                            </thead>
                            <tbody>
                               <!-- sql -->
                           </tbody>
                       </table>
                   </div>
               </div>
               <!-- macro form -->
               <p>
                <form class="form-horizontal" id='macroForm' role="form" action="./firewall/index.php?page=macro" method="post">
                    <!-- Bouton qui supprime la macro -->
<!--                    <td>
                        <a href="./firewall/index.php?page=delete_macro=<?php echo $line["id"]; ?>" title="Supprime une macro"><button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Supprimer</button></a>
                    </td>
-->
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="name_macro">Nom de la Macro</label>
                  <div class="col-sm-10">
                   <input type="text" class="form-control" name="nomMacro" placeholder="Nom (max : 20 caractères)" required pattern="^[_\.]{1,20}$">
               </div>
           </div>

           <div class="form-group">
              <label class="col-sm-2 control-label" for="IPServer">Fonction de la Macro</label>
              <div class="col-sm-10">
               <input type="text" class="form-control" name="fonction" placeholder="sis0">
           </div>
       </div>
       <div class="form-group">
          <label class="col-sm-2 control-label" for="button"></label>
          <div class="col-sm-10">
           <button type="submit" class="btn btn-success" id="macro"><i class="glyphicon glyphicon-plus"></i> Ajouter </button>
       </div>
   </div>
</form>
</p>
</div>
</div>
</div>