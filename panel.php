<?php if ('panel.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('No cargar este archivo directamente.');
?>

<script type="text/javascript">
function actualiza()
{
	var theme=document.getElementById('theme').value
	if (theme == 'white or blanco')
	{
		document.getElementById('background').value='#000'
		document.getElementById('opacity').value='0.6'
		document.getElementById('show_duration').value='200'
		document.getElementById('close_duration').value='400'
		document.getElementById('hex').value='#fff'
		document.getElementById('cpc').value='#000'
		
		
	}
	else
	{
		document.getElementById('background').value='#000'
		document.getElementById('opacity').value='0.6'
		document.getElementById('show_duration').value='200'
		document.getElementById('close_duration').value='400'
		document.getElementById('hex').value='#000'
		document.getElementById('cpc').value='#fff'
	}
}
</script>

<div class="wrap">
		<h2>Configuracion de SexyLightBox</h2>
		
		<form method="post">
		<table class="form-table">
		 <tr valign="top">
		  <th scope="row">Libreria</th>
	      <td><select name="library" id="library">
          <option value=""></option>
		  <option value="mootools" <?php if (get_option('sexy_library')==mootools) echo 'selected="selected"'?>>Mootools</option>
          <option value="jquery" <?php if (get_option('sexy_library')==jquery) echo 'selected="selected"'?>>jQuery</option>
	        </select>	      </td>
          <td>
          	<input type="checkbox" <?php if (get_option('sexy_compressed')==ys) echo 'checked="checked"'?> name="compressed" id="compressed" value="ys" />Utilizar la versi&oacute;n comprimida de sexylightbox.
          </td>  
         </tr>
         <tr valign="top">
          <th scope="row">Direcci&oacute;n de aparici&oacute;n</th>
          <td><select name="direction" id="direction">
          <option value=""></option>
		  <option value="top" <?php if (get_option('sexy_direction')==top) echo 'selected="selected"'?>>Desde arriba</option>
          <option value="bottom" <?php if (get_option('sexy_direction')==bottom) echo 'selected="selected"'?>>Desde abajo</option>
	        </select>		  </td>
         </tr>   
		 <tr valign="top">
		  <th scope="row">Tema</th>
	      <td><select name="theme" id="theme" onChange="actualiza()">
          <option value=""></option>
		  <option value="negro" <?php if (get_option('sexy_theme')==negro) echo 'selected="selected"'?>>Negro</option>
          <option value="blanco" <?php if (get_option('sexy_theme')==blanco) echo 'selected="selected"'?>>Blanco</option>
          <option value="black" <?php if (get_option('sexy_theme')==black) echo 'selected="selected"'?>>Black</option>
          <option value="white" <?php if (get_option('sexy_theme')==white) echo 'selected="selected"'?>>White</option>
	        </select>	      </td>
         </tr>
         <tr valign="top">
          <th scope="row">Fondo</th>
          <td>
            <input type="text" name="background" id="background" value="<?php echo get_option('sexy_background');?>"/>          </td> 
         </tr>
         <tr valign="top">
           <th scope="row">Opacidad</th>
           <td><input type="text" name="opacity" id="opacity" value="<?php echo get_option('sexy_opacity');?>"/></td>
         </tr>
         <tr valign="top">
		  <th scope="row">Duraci&oacute;n para mostrar(ms)</th>
          <td><input type="text" name="show_duration" id="show_duration" value="<?php echo get_option('sexy_show_duration');?>"/></td>
         </tr>
         <tr valign="top">
		  <th scope="row">Duraci&oacute;n para cerrar(ms)</th>
          <td><input type="text" name="close_duration" id="close_duration" value="<?php echo get_option('sexy_close_duration');?>"/></td>
         </tr>
         <tr valign="top">
		  <th scope="row">Color hexadecimal</th>
          <td><input type="text" name="hex_color" id="hex" value="<?php echo get_option('sexy_hex_color');?>"/></td>
         </tr>
         <tr valign="top">
		  <th scope="row">Color del texto</th>
          <td><input type="text" name="caption_color" id="cpc" value="<?php echo get_option('sexy_caption_color');?>"/></td>
         </tr>
         </table>      

       <div class="submit">
           <input type="submit" name="save_sexy_settings" value="<?php _e('Guardar configuracion', 'save_sexy_settings') ?>" />
        </div>
  </form>
    </div>