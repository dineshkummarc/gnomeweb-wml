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

class Bounty {
	public string title;
	public string amount;
	public string category;
	public string html;
	public string solved;
	public string who;
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
			b.html       = GetXmlNodeText (bounty_xml, "html");
			b.solved     = GetXmlNodeText (bounty_xml, "solved");
			b.who        = "";

			if (b.solved != "") {
			   XmlNode node;
			   XmlAttribute attrib;

			   node = bounty_xml.SelectSingleNode("solved");

			   attrib = node.Attributes["who"];

			   if (attrib != null)
			      b.who = attrib.InnerText;
			}

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

	static ArrayList GetWinners (ArrayList bounties)
	{
		ArrayList winners = new ArrayList ();

		foreach (Bounty b in bounties) {
			Category winner;
			if (b.solved != "")
			   winners.Add (b);
		}

		return winners;

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

	static void OutputTaskRow (Bounty b, StreamWriter sw, bool show_category)
	{
		string cat = b.category;

		if (cat == "Ignore")
			return;

		if (! show_category)
			cat = "hidden";

		sw.WriteLine ("<?php taskrow (\"{0}\", \"{1}\", \"{2}\", \"{3}\", \"{4}\"); ?>",
				   b.title, cat, b.amount, b.id, b.solved);

	}

	static void OutputTable (ArrayList bounties, StreamWriter sw, bool show_category)
	{
		if (show_category)
			sw.WriteLine ("<?php write_table_header (\"yes\"); ?>");
		else
			sw.WriteLine ("<?php write_table_header (\"no\"); ?>");

		foreach (Bounty b in bounties) {
			if (b.solved == "")
				OutputTaskRow (b, sw, show_category);
		}
		sw.WriteLine ("<?php write_table_footer (); ?>");
	}

	static void OutputSolvedTable (ArrayList bounties, StreamWriter sw, bool show_category)
	{
		if (show_category)
			sw.WriteLine ("<?php write_table_header (\"yes\"); ?>");
		else
			sw.WriteLine ("<?php write_table_header (\"no\"); ?>");

		foreach (Bounty b in bounties) {
			if (b.solved != "")
				OutputTaskRow (b, sw, show_category);
		}
		sw.WriteLine ("<?php write_table_footer (); ?>");
	}

	static void OutputBounties (ArrayList bounties, StreamWriter sw)
	{
		foreach (Bounty b in bounties) {
			if (b.solved == "") {
				sw.WriteLine ("<?php box_start (\"{0}\", \"{1}\", \"{2}\", \"{3}\", \"{4}\"); ?>",
					      b.title, b.category, b.amount, b.id, b.bug);
				sw.Write (b.html);
				sw.WriteLine ("<?php box_end (); ?>");
			}
		}
	}

	static void OutputSolvedBounties (ArrayList bounties, StreamWriter sw)
	{
		foreach (Bounty b in bounties) {
			if (b.solved != "") {
				sw.WriteLine ("<?php box_start (\"{0}\", \"{1}\", \"{2}\", \"{3}\", \"{4}\", \"{5}\", \"{6}\"); ?>",
					      b.title, b.category, b.amount, b.id, b.bug, b.solved, b.who);
				sw.Write (b.html);
				sw.WriteLine ("<?php box_end (); ?>");
			}
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

		OutputTable (c.bounties, c.sw, false);
		OutputBounties (c.bounties, c.sw);
		
		PasteFile ("cat-footer.php", c.sw);

		c.sw.Flush ();
		c.sw.Close ();
	}

	static void OutputWinnersFile (ArrayList c)
	{
		FileStream f;

		try {
			f = File.Open ("Winners.php", FileMode.Create);
		} catch (Exception e) {
			Console.WriteLine ("Error opening file: {0}", "Winners.php3");
			Console.WriteLine ("Exception: {0}", e);
			return;
		}

		StreamWriter sw = new StreamWriter (f);

		PasteFile ("cat-header.php", sw);
		
		sw.WriteLine ("<?php write_page_header (\"Bounty Winners\"); ?>");

		OutputSolvedTable (c, sw, true);
		OutputSolvedBounties (c, sw);
		
		PasteFile ("cat-footer.php", sw);

		sw.Flush ();
		sw.Close ();
		
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

		sw.WriteLine ("<a name=\"table\">");

		OutputTable (bounties, sw, true);
		
		PasteFile ("footer.php", sw);

		sw.Flush ();
		sw.Close ();
	}

	static void PrintTotalBountyExposure (ArrayList bounties)
	{
		int total = 0;
		int solve = 0;

		foreach (Bounty b in bounties) {
			if ((b.category != "Ignore") &&
			   (b.solved == ""))
				total += Int32.Parse (b.amount);
			if ((b.category != "Ignore") &&
			   (b.solved != ""))
				solve += Int32.Parse (b.amount);
		}

		Console.WriteLine ("Total bounties: {0}", total + solve);
		Console.WriteLine ("Total Solved: {0}", solve);
		Console.WriteLine ("Total Unsolved: {0}", total);

	}

	static void Main (string [] args)
	{
		ArrayList bounties = LoadBounties ("./bounties.xml");

		ArrayList cats = GetCategories (bounties);

		ArrayList win = GetWinners (bounties);

		foreach (Category c in cats)
			OutputCategoryFile (c);

		OutputWinnersFile (win);
		
		PrintGlobalTable (bounties);

		PrintTotalBountyExposure (bounties);
	}
}
