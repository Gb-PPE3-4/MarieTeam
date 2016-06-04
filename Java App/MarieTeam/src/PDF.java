
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
/**
 * <b>PDF classe technique de manipulation du PDF.</b>
 * <p>
 * <ul>
 * <li>Une instance de PDF.</li>
 * <li>Une instance de Document.</li>
 * <li>Un nomDoc.</li>
 * </ul>
 * </p>
 * 
 * @author pierre vandesompele, raphael polowczak, robin faure
 */
public class PDF {
    
    String nomDoc;
    PDF monPDF;
    static String lienImage = "http://localhost/marieteam/Web%20App/images/" ;
    Document document = new Document(PageSize.A4);
    

    /**
     * Constructeur PDF avec un nom de document.
     * 
     * @param nomDocument
     *            Un nom pour le document édité.
     *            
     */
    public PDF (String nomDocument) throws FileNotFoundException, DocumentException{
    	this.nomDoc = nomDocument ;
        PdfWriter.getInstance(document, new FileOutputStream(nomDoc));
        document.open();
    }

    /**
     * Ecrire le texte passe en parametre
     * 
     * @param leTexte un texte à ecrire.
     * 
     */
    public void ecrireTexte (String leTexte) throws DocumentException{
    	document.add(new Phrase(leTexte));
    }

    /**
     * Charger une image a partir de l'url
     * 
     * @param chemin de l'image.
     * 
     */
    public void chargerImage (String chemin) throws MalformedURLException, IOException, DocumentException{   
    	Image image = Image.getInstance(lienImage+chemin) ;
	    image.scalePercent(30f) ;
	    image.setAlignment(Image.LEFT) ;
	    document.add(image) ;
    }

    /**
     * Fermer le document et terminer son edition.
     * 
     */
    public void fermer(){
    	document.close();
    }
}
