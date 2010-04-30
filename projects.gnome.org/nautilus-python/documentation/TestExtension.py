import nautilus

class SimpleMenuExtension(nautilus.MenuProvider):
    def __init__(self):
        pass
    
    def menu_activate_cb(self, menu, file):
        print "menu_activate_cb",file
    
    def get_file_items(self, window, files):
        if len(files) != 1:
            return
        
        file = files[0]

        item = nautilus.MenuItem(
            "SimpleMenuExtension::Show_File_Name",
            "Showing %s" % file.get_name(),
            "Showing %s" % file.get_name()
        )
        item.connect('activate', self.menu_activate_cb, file)
        
        return [item]
