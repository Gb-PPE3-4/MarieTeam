import java.util.ArrayList;

import java.awt.*;

import java.io.*;
import java.net.MalformedURLException;
import java.net.URL;
import java.sql.SQLException;

import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Image;
import com.itextpdf.text.PageSize;
import com.itextpdf.text.Phrase;
import com.itextpdf.text.pdf.PdfWriter;

import com.itextpdf.text.*;

public class Main {

	private final static String out = "Brochure.pdf";
	
	public static void main(String[] args) {
		
		PDF lePDF = null ;
		
		try {
			lePDF = new  PDF(out);
			System.out.println("Brochure de bateaux voyageurs");
			lePDF.ecrireTexte("Brochure de bateaux voyageurs");
			
			Passerelle pass = new Passerelle() ;
			ArrayList<BateauVoyageur> listBateaux = pass.chargerLesBatVoy() ;
			for( BateauVoyageur unBateau : listBateaux ){
				lePDF.ecrireTexte(System.getProperty("line.separator")) ;
				lePDF.ecrireTexte(unBateau.getNom());
				lePDF.ecrireTexte(System.getProperty("line.separator")) ;
				lePDF.chargerImage(unBateau.getImageBatVoyageur());
				lePDF.ecrireTexte(System.getProperty("line.separator")) ;
				lePDF.ecrireTexte(unBateau.toString());
				lePDF.ecrireTexte(System.getProperty("line.separator")) ;
			}
	        Fenetre uneFen = new Fenetre(listBateaux) ;
	    	uneFen.setVisible(true);
			
		} catch (FileNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (DocumentException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		//} catch (MalformedURLException e) {
			// TODO Auto-generated catch block
			//e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}finally{
			lePDF.fermer() ;
		}
        System.out.println("Document PDF  generated");
	}
}
