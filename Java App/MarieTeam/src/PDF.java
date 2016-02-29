
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.net.MalformedURLException;
import java.util.*;

import com.itextpdf.text.BadElementException;
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Image;
import com.itextpdf.text.PageSize;
import com.itextpdf.text.Phrase;
import com.itextpdf.text.pdf.PdfWriter;

public class PDF {
    
    String nomDoc;
    BateauVoyageur monBatVoy ;
    PDF monPDF;
    Document document = new Document(PageSize.A4);
    
    // Constructeur
    public PDF (String nomDocument) throws FileNotFoundException, DocumentException{
    	this.nomDoc = nomDocument ;
        PdfWriter.getInstance(document, new FileOutputStream(nomDoc));
        document.open();
    }
    
    // ecrire le texte passe en parametre
    public void ecrireTexte (String leTexte) throws DocumentException{
    	document.add(new Phrase(leTexte));
    }
    
    // charger une image a partir de l'url en relatif
    public void chargerImage (String chemin) throws MalformedURLException, IOException, DocumentException{   
    	// Image image = Image.getInstance("/MarieTeam/"+chemin) ;
    	Image image = Image.getInstance("C:/Users/Pierre/workspace/MarieTeam/img/"+chemin) ;
	    image.scalePercent(30f) ;
	    image.setAlignment(Image.LEFT) ;
	    document.add(image) ;
    }
    
    // fermer le document
    public void fermer(){
    	document.close();
    }
}
