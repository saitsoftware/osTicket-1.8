<?php
// Strobe Technologies Ltd | 21/10/2014 | Ticket Time Menu allowing you to enable and disable options / views

if(!defined('OSTADMININC') || !$thisstaff || !$thisstaff->isAdmin() || !$config) die('Access Denied');
?>
<h2><?php echo __('Configuracion');?></h2>
<form action="settings.php?t=tickettime" method="post" id="save">
<?php csrf_token(); ?>
<input type="hidden" name="t" value="tickettime" >
<table class="form_table settings_table" width="940" border="0" cellspacing="0" cellpadding="2">
    <thead>
        <tr>
            <th colspan="2">
                <h4><?php echo __('Configuracion del Tiempo en Tickets');?></h4>
                <em><?php echo __("Activando estas opciones permites agregar tiempo a tus tickets.");?></em>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="180"><?php echo __('Estado del Tiempo Invertido:'); ?>:</td>
            <td>
                <input type="checkbox" name="isclienttime" value="1" <?php echo $config['isclienttime']?'checked="checked"':''; ?>>
                <?php echo __('Activar Ver el Tiempo al Cliente'); ?>
                &nbsp;<font class="error">&nbsp;<?php echo $errors['isclienttime']; ?></font>
                <i class="help-tip icon-question-sign" href="#"></i>
            </td>
        </tr>
        <tr>
            <td width="180"><?php echo __('Tiempo Invertido Total del Ticket:');?>:</td>
            <td>
                <input type="checkbox" name="istickettime" value="1" <?php echo $config['istickettime']?'checked="checked"':''; ?> >
                <?php echo __('Activer Agregar Tiempo Invertido a los Tickets Via Accion.'); ?>
                &nbsp;<font class="error">&nbsp;<?php echo $errors['istickettime']; ?></font>
                <i class="help-tip icon-question-sign" href="#"></i>
            </td>
        </tr>
		<tr>
            <td width="180"><?php echo __('Tiempo del Hilo del Ticket:');?>:</td>
            <td>
                <input type="checkbox" name="isthreadtime" value="1" <?php echo $config['isthreadtime']?'checked="checked"':''; ?> >
                <?php echo __('Activer Agregar Tiempo Invertido a los Tickets via Hilos'); ?>
                &nbsp;<font class="error">&nbsp;<?php echo $errors['isthreadtime']; ?></font>
                <i class="help-tip icon-question-sign" href="#"></i>
            </td>
        </tr>
    </tbody>
</table>
<p style="padding-left:210px;">
    <input class="button" type="submit" name="submit" value="<?php echo __('Save Changes'); ?>">
    <input class="button" type="reset" name="reset" value="<?php echo __('Reset Changes'); ?>">
</p>
</form>
