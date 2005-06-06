using System;
using System.IO;
using System.Xml;
using System.Collections;

class Category {
	public string name;
	public string path;
	public StreamWriter sw;
	public ArrayList bounties;
}

class Funder {
	public string name;
	public string path;
	public StreamWriter sw;
	public ArrayList bounties;
}

class Bounty {
	public string title;
	public string amount;
	public string category;
	public string funder;
	public string html;
	public string solved;
        public int    bug;
	public int    id;

	public void print ()
	{
		Console.WriteLine ("Bounty: [{0}]\n    {1} {2}\n    HTML: [{3}]\n", this.title, this.amount, this.category, this.html);
	}
}

class DoIt {
	static ArrayList LoadBounties (string path)
	{
		XmlDocument xml = new XmlDocument ();

		xml.Load (path);

		ArrayList bounties = new ArrayList ();

		XmlNodeList bounties_xml = xml.SelectNodes ("//bounty");

		foreach (XmlNode bounty_xml in bounties_xml) {

		        String tmp;

			Bounty b = new Bounty ();
			b.title      = GetXmlNodeText (bounty_xml, "title");
			b.amount     = GetXmlNodeText (bounty_xml, "amount");
			b.category   = GetXmlNodeText (bounty_xml, "category");
			b.funder     = GetXmlNodeText (bounty_xml, "funder");
			b.html       = GetXmlNodeText (bounty_xml, "html");
			b.solved     = GetXmlNodeText (bounty_xml, "solved");			

			tmp          = GetXmlNodeText (bounty_xml, "bug");
			
			if (tmp != "") {
			        b.bug = Int32.Parse (tmp);
			        b.id  = b.bug;
			} else {
			        b.bug = 0;
			        b.id  = Math.Abs (b.title.GetHashCode ());
			}

			bounties.Add (b);

			//			b.print ();
		}

		return bounties;
	}

	static string GetXmlNodeText (XmlNode xml, string tag)
	{
		XmlNode node;
		node = xml.SelectSingleNode (tag);
		if (node == null)
			return "";

		return node.InnerText;
	}

	static Category GetCategory (ArrayList cats, string name)
	{
		foreach (Category c in cats) {
			if (c.name == name)
				return c;
		}

		Category cat = new Category ();
		cat.name = name;
		cat.path = name + ".php3";
		cat.bounties = new ArrayList ();

		cats.Add (cat);

		return cat;
	}

	static ArrayList GetCategories (ArrayList bounties)
	{
		ArrayList cats = new ArrayList ();

		foreach (Bounty b in bounties) {
			Category cat;
			cat = GetCategory (cats, b.category);

			cat.bounties.Add (b);
		}

		return cats;
	}


	static Funder GetFunder (ArrayList funders, string name)
	{
		foreach (Funder f in funders) {
			if (f.name == name)
				return f;
		}

		Funder funder = new Funder ();
		funder.name = name;
		funder.path = name + ".php3";
		funder.bounties = new ArrayList ();

		funders.Add (funder);

		return funder;
	}

	static ArrayList GetFunders (ArrayList bounties)
	{
		ArrayList funders = new ArrayList ();

		foreach (Bounty b in bounties) {
			Funder funder;
			funder = GetFunder (funders, b.funder);

			funder.bounties.Add (b);
		}

		return funders;
	}

	static ArrayList GetSolved (ArrayList bounties)
	{
		ArrayList solved = new ArrayList ();

		foreach (Bounty b in bounties) {
			if (b.solved != null && b.solved.Length > 0)
				solved.Add (b);
		}

		return solved;
	}

	static void PasteFile (string path, StreamWriter sw)
	{
		FileStream header;

		try {
			header = File.Open (path, FileMode.Open);
		} catch {
			Console.WriteLine ("Could not open paste file " + path);
			return;
		}

		StreamReader sr = new StreamReader (header);
		string text = sr.ReadToEnd ();

		sw.Write (text);

		sr.Close ();
	}

	static void OutputTable (ArrayList bounties, StreamWriter sw, bool show_category, bool show_funded_by,
				 bool show_solved)
	{
		string show_cat_yesno = show_category ? "yes" : "no";
		string show_funder_yesno = show_funded_by ? "yes" : "no";
		sw.WriteLine (String.Format ("<?php write_table_header (\"{0}\", \"{1}\"); ?>",
					     show_cat_yesno, show_funder_yesno));

		foreach (Bounty b in bounties) {
			string cat = b.category;

			if (cat == "Ignore")
				continue;

			if (! show_category)
				cat = "hidden";

			if (! show_solved && (b.solved != null && b.solved.Length > 0))
				continue;

			string funder = b.funder;
			if (! show_funded_by)
				funder = "hidden";

			sw.WriteLine ("<?php taskrow (\"{0}\", \"{1}\", \"{2}\", \"{3}\", \"{4}\", \"{5}\"); ?>",
					   b.title, cat, funder, b.amount, b.id, b.solved);
		}
		sw.WriteLine ("<?php write_table_footer (); ?>");
	}

	static void OutputBounties (ArrayList bounties, StreamWriter sw)
	{
		foreach (Bounty b in bounties) {
			string cat = b.category;

			if (cat == "Ignore")
				continue;
			
			sw.WriteLine ("<?php box_start (\"{0}\", \"{1}\", \"{2}\", \"{3}\", \"{4}\", \"{5}\"); ?>",
					   b.title, b.category, b.amount, b.id, b.bug, b.solved);
			sw.Write (b.html);
			sw.WriteLine ("<?php box_end (); ?>");
		}
	}

	static void OutputCategoryFile (Category c)
	{
		FileStream f;

		if (c.name == "Ignore")
			return;

		try {
			f = File.Open (c.path, FileMode.Create);
		} catch (Exception e) {
			Console.WriteLine ("Error opening file: {0}", c.path);
			Console.WriteLine ("Exception: {0}", e);
			return;
		}

		c.sw = new StreamWriter (f);

		PasteFile ("cat-header.php", c.sw);

		c.sw.WriteLine ("<?php write_page_header (\"{0}\"); ?>", c.name + " Bounties");

		OutputTable (c.bounties, c.sw, false, true, true);
		OutputBounties (c.bounties, c.sw);
		
		PasteFile ("cat-footer.php", c.sw);

		c.sw.Flush ();
		c.sw.Close ();
	}

	static void OutputFunderFile (Funder funder)
	{
		FileStream f;

		if (funder.name == "Ignore")
			return;

		try {
			f = File.Open (funder.path, FileMode.Create);
		} catch (Exception e) {
			Console.WriteLine ("Error opening file: {0}", funder.path);
			Console.WriteLine ("Exception: {0}", e);
			return;
		}

		funder.sw = new StreamWriter (f);

		PasteFile ("cat-header.php", funder.sw);

		funder.sw.WriteLine ("<?php write_page_header (\"{0}\"); ?>", "Bounties funded by " + funder.name);

		OutputTable (funder.bounties, funder.sw, true, false, true);
		OutputBounties (funder.bounties, funder.sw);
		
		PasteFile ("cat-footer.php", funder.sw);

		funder.sw.Flush ();
		funder.sw.Close ();
	}

	static void PrintGlobalTable (ArrayList bounties)
	{
		FileStream f;

		try {
			f = File.Open ("index.php3", FileMode.Create);
		} catch (Exception e) {
			Console.WriteLine ("Error opening file: {0}", "index.php3");
			Console.WriteLine ("Exception: {0}", e);
			return;
		}

		StreamWriter sw = new StreamWriter (f);

		PasteFile ("header.php", sw);

		sw.WriteLine ("<a STYLE=\"text-decoration:none\" name=\"table\">");

		sw.WriteLine ("<a name=\"unclaimed\"></a><h2>Unclaimed Bounties</h2>");
		OutputTable (bounties, sw, true, true, false);

		sw.WriteLine ("<a name=\"claimed\"></a><h2>Already Claimed Bounties</h2>");
		ArrayList solved = GetSolved (bounties);
		OutputTable (solved, sw, true, true, true);
		
		PasteFile ("footer.php", sw);

		sw.Flush ();
		sw.Close ();
	}

	static void PrintTotalBountyExposure (ArrayList bounties)
	{
		int total = 0;
		int n = 0;

		foreach (Bounty b in bounties) {
			if (b.category != "Ignore") {
				total += Int32.Parse (b.amount);
				n++;
			}
		}

		Console.WriteLine ("Total bounties: ${0} ({1})", total, n);

		total = 0;
		n = 0;
		foreach (Bounty b in bounties) {
			if (b.category != "Ignore" && b.solved.Length == 0) {
				total += Int32.Parse (b.amount);
				n ++;
			}
		}

		Console.WriteLine ("Total unclaimed bounties: ${0} ({1})", total, n);

		total = 0;
		n = 0;
		foreach (Bounty b in bounties) {
			if (b.category != "Ignore" && b.solved.Length > 0) {
				total += Int32.Parse (b.amount);
				n ++;
			}
		}

		Console.WriteLine ("Total claimed bounties: ${0} ({1})", total, n);
	}

	static void Main (string [] args)
	{
		ArrayList bounties = LoadBounties ("./bounties.xml");

		ArrayList cats = GetCategories (bounties);
		ArrayList funders = GetFunders (bounties);

		foreach (Category c in cats)
			OutputCategoryFile (c);

		foreach (Funder f in funders)
			OutputFunderFile (f);

		PrintGlobalTable (bounties);

		PrintTotalBountyExposure (bounties);
	}
}
