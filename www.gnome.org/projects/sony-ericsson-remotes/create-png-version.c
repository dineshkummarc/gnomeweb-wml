
#include <librsvg/rsvg.h>
#include <librsvg/rsvg-cairo.h>
#include <cairo.h>

int main (int argc, char **argv)
{
	RsvgDimensionData dimensions;
	RsvgHandle *logo_handle;
	cairo_surface_t *surface;
	GError *error = NULL;
	cairo_t *cr;
	cairo_status_t status;
	char *input, *size, *output;
	GString *layer;
	char *layer_name;
	int h, w;

	g_type_init ();

	input = argv[1];
	size = argv[2];
	layer = g_string_new (argv[3]);
	g_string_ascii_down (layer);
	g_string_prepend_c (layer, '#');
	output = argv[4];

	if (sscanf (size, "%dx%d", &w, &h) != 2) {
		g_warning ("Couldn't parse size '%s'", size);
		return 1;
	}

	logo_handle = rsvg_handle_new_from_file (input, &error);
	if (!logo_handle) {
		g_warning ("Couldn't open '%s': %s", input, error->message);
		g_error_free (error);
		return 1;
	}

	surface = cairo_image_surface_create (CAIRO_FORMAT_RGB24, w, h);
	cr = cairo_create (surface);

	rsvg_handle_get_dimensions (logo_handle, &dimensions);
	cairo_scale (cr,
		     (double) w / dimensions.width,
		     (double) h / dimensions.height);

	layer_name = g_string_free (layer, FALSE);
	rsvg_handle_render_cairo_sub (logo_handle, cr, "#background");
//	rsvg_handle_render_cairo_sub (logo_handle, cr, "#base");
	rsvg_handle_render_cairo_sub (logo_handle, cr, layer_name);

	status = cairo_surface_write_to_png (surface, output);
	if (status != CAIRO_STATUS_SUCCESS) {
		g_warning ("Couldn't write output '%s': %s", output, cairo_status_to_string (status));
		return 1;
	}

	g_free (layer_name);
	cairo_destroy (cr);

	return 0;
}

