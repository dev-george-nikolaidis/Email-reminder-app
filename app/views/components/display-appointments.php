<!-- The CSS styles can be found at app/resources/components/_display-appointments.scss  -->


<table class="display-appointments">
    <tr class="table-header">
        <th>Datum</th>
        <th>Bezeichnung</th>
        <th>Erinnerung</th>
        <th>Aktion</th>
    </tr>
    <?php if (isset($_SESSION["appointments"])) : ?>

        <?php if (count($_SESSION["appointments"]) > 0) : ?>

            <?php foreach ($_SESSION["appointments"] as $key => $value) : ?>

                <tr data-row-id=<?php echo $value->id ?> class="data-row">

                    <td>
                        <input type="text" value="<?php echo $value->input_date . "." ?>" class="day">
                        <input type="text" value="<?php echo $value->input_month . "." ?>" min="1" max="31" class="month">
                    </td>

                    <td class="td-description">
                        <input type="text" value="<?php echo $value->description ?>" class="description">
                    </td>

                    <td>
                        <!-- <input type="text" value="<?php echo $value->time_reminder ?>" class="time-reminder"> -->
                        <select class="select-update">
                            <!-- <option value="" selected disabled hidden> --bitte auswählen </option> -->
                            <option value="1 Tag" <?php echo $value->time_reminder === "1 Tage" ? "selected disabled" : null ?>>1 Tag</option>
                            <option value="2 Tage" <?php echo $value->time_reminder === "2 Tage" ? "selected disabled" : null ?>>2 Tage</option>
                            <option value="4 Tage" <?php echo $value->time_reminder === "4 Tage" ? "selected disabled" : null ?>>4 Tage</option>
                            <option value="1 Woche" <?php echo $value->time_reminder === "1 Woche" ? "selected disabled" : null ?>>1 Woche</option>
                            <option value="2 Wochen" <?php echo $value->time_reminder === "2 Wochen" ? "selected disabled" : null ?>>2 Wochen</option>
                        </select>
                    </td>

                    <td class="buttons-container">
                        <span class="edit">bearbeiten</span>
                        <span>|</span>
                        <span class="delete">löschen</span>
                    </td>

                </tr>

            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
</table>