<form action="#" method="get" id="sort">
    <fieldset>
        <legend>Sort</legend><br />

        <div class="forminput">
            <div class="form-inline">
                <label for="SortColumn">Column</label>&nbsp;&nbsp;&nbsp;
                <select name="column" class="form-control" id="SortColumn">
                    <?php
                    $results = getColumns();
                    foreach ($results as $row): ?>
                        <option value="<?php echo $row ?>"><?php echo $row ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br />

            <div class="custom-control custom-radio">
                <input type="radio" id="customRadio1" name="order" class="custom-control-input" value="ASC">
                <label class="custom-control-label" for="customRadio1">Ascending</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" id="customRadio2" name="order" class="custom-control-input" value="DESC">
                <label class="custom-control-label" for="customRadio2">Descending</label>
            </div>
        </div>
            
        <input type="hidden" name="action" value="sort" />
        <input type="submit" value="Sort" class="btn btn-primary" />
        <input type="submit" name="reset" value="Reset" class="btn btn-danger" />
    </fieldset>    
</form>