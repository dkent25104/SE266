<form action="#" method="get" id="search">
    <fieldset>
        <legend>Search</legend><br />
        
        <div class="forminput">
            <div class="form-inline">
                <label for="SearchColumn">Column</label>&nbsp;&nbsp;&nbsp;
                <select name="column" class="form-control" id="SearchColumn">
                    <?php
                    $results = getColumns();
                    foreach ($results as $row): ?>
                        <option value="<?php echo $row ?>"><?php echo $row ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br />

            <div class="form-inline">
                <label for="SearchKeyword">Keyword</label>&nbsp;&nbsp;&nbsp;
                <input name="keyword" type="search" placeholder="Search...." class="form-control" id="SearchKeyword" />
            </div>
        </div>
        
        <input type="hidden" name="action" value="search" />
        <input type="submit" value="Search" class="btn btn-primary" />
        <input type="submit" name="reset" value="Reset" class="btn btn-danger" />
    </fieldset>            
</form>