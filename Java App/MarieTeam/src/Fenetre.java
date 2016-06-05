import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.Container;
import java.awt.Dimension;
import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent ;
import java.awt.event.MouseListener ;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.net.MalformedURLException;
import java.sql.SQLException;
import java.util.ArrayList;

import javax.swing.BoxLayout;
import javax.swing.JButton;
import javax.swing.JCheckBox;
import javax.swing.JFrame ;
import javax.swing.JLabel;
import javax.swing.JList;
import javax.swing.JPanel;
import javax.swing.JTextArea;
import javax.swing.JTextField;

import com.itextpdf.text.DocumentException;
public class Fenetre extends JFrame implements ActionListener{

	// TRAITEMENT
	private ArrayList<BateauVoyageur> listBateaux = new ArrayList<BateauVoyageur>() ;
	private ArrayList<BateauVoyageur> listBateauxSlcted = new ArrayList<BateauVoyageur>() ; 
	// GUI
	// PANELS
    private JPanel panelGaucheList = new JPanel() ;
	private JPanel panelDroiteList = new JPanel() ;
	// BOUTONS
	private JButton boutonAjouter = new JButton("Ajouter") ;
	private JButton boutonRetirer = new JButton("Retirer") ;
	private JButton boutonEditer = new JButton("Editer") ;
	// LABELS
	private JLabel libTitre = new JLabel("     Edition de brochure de bateaux") ;
	private JLabel libBatSlct = new JLabel("     Liste des bateaux :") ;
	private JLabel libBatSlcted = new JLabel("     Bateaux sélectionnés :") ;
	// TEXT AREA POUR BATEAUX DE LA SELECTION
	private JTextArea textBateauxSlcted = new JTextArea() ;
	
	public Fenetre(ArrayList<BateauVoyageur> listBateaux){

		setTitle("Edition de brochure") ;
		this.listBateaux = listBateaux ;
		Container cPane = getContentPane() ;
		
		// LAYOUTS
		cPane.setLayout(new BorderLayout());
        panelGaucheList.setLayout(new BoxLayout(panelGaucheList, BoxLayout.Y_AXIS));
        panelDroiteList.setLayout(new BoxLayout(panelDroiteList, BoxLayout.Y_AXIS));
		
		// TAILLES
		setSize(500,450) ;
		libTitre.setPreferredSize(new Dimension(50, 50)) ;
        libBatSlct.setPreferredSize(new Dimension(200, 100)) ;
        libBatSlcted.setPreferredSize(new Dimension(250, 20)) ;
        textBateauxSlcted.setPreferredSize(new Dimension(60, 60)) ;
		
		// BACKGROUND COLORS
		cPane.setBackground(new Color(0, 114, 255)); 
        panelGaucheList.setBackground(new Color(0, 114, 255)); 
        panelDroiteList.setBackground(new Color(0, 114, 255)); 
        textBateauxSlcted.setBackground(Color.white);
		
		// TXT COLORS
		libTitre.setForeground(Color.white);
		libBatSlct.setForeground(Color.white);
        libBatSlcted.setForeground(Color.white);
		
		// En-tête
		cPane.add(libTitre, BorderLayout.PAGE_START);
        
        // A gauche LIBELLE & LISTE
        panelGaucheList.add(libBatSlct) ;
        // APPEL CONSTRUCTION LIST BATEAU DANS PANEL
        addListBat() ;
        cPane.add(panelGaucheList, BorderLayout.LINE_START);
        
        // CONFIG TEXT AREA
        textBateauxSlcted.setEditable(false) ;
        textBateauxSlcted.setRows(this.listBateaux.size()) ;
        
        // A droite LIBELLE & LISTE
        panelDroiteList.add(libBatSlcted) ;
        panelDroiteList.add(textBateauxSlcted) ;
        cPane.add(panelDroiteList, BorderLayout.LINE_END);

        // Bas de page
        boutonEditer.addActionListener(this) ;
        cPane.add(boutonEditer, BorderLayout.PAGE_END);
	}
	
	// Récupère la liste des bateaux et les affiche les uns après les autres (GUI)
	public void addListBat(){
		JButton bateau ;
		for( BateauVoyageur unBateau : this.listBateaux ){
			bateau = new JButton(unBateau.getNom()) ;
			bateau.setPreferredSize(new Dimension(70, 30)) ;
			bateau.addActionListener(this) ;
			// TODO ajouter ecouteur
			this.panelGaucheList.add(bateau) ;
		}
	}
	
	// GET BATEAU A PARTIR DU NOM
	public BateauVoyageur getBateauFromList(String nom){
		BateauVoyageur bateau = new BateauVoyageur() ;
		for(BateauVoyageur unBateau : this.listBateaux){
			if(nom.equals(unBateau.getNom())){
				bateau = unBateau ;
			}
		}
		return bateau;		
	}
		
	// AJOUTE UN BATEAU DANS LA SELECTION
	public void ajouteBateauAList(BateauVoyageur bateau){
		this.listBateauxSlcted.add(bateau) ;	
	}
	
	// RETIRE UN BATEAU DANS LA SELECTION
	public void retireBateauAList(BateauVoyageur bateau){
		this.listBateauxSlcted.remove( this.listBateauxSlcted.indexOf(bateau) ) ;	
	}
	
	// MAJ GUI VUE DES BATEAUX SELECTIONNES
	public void majVueBateauSlcted(){
		String liste = "" ;
		
		for( BateauVoyageur unBateau : this.listBateauxSlcted ){
			liste = liste + " - " + unBateau.getNom() + System.getProperty("line.separator") ;
		}
		System.out.println(liste); 
		this.textBateauxSlcted.setText(liste); ;
	}
	
	// AJOUTE OU RETIRE UN BATEAU DE LA SELECTION D'APRES SON NOM
	public void actionBateauSlcted(String nom){
		if(nom != ""){
			BateauVoyageur bateau = getBateauFromList(nom) ;
			if(this.listBateauxSlcted.contains(bateau)){
				retireBateauAList(bateau) ;
			}else{
				ajouteBateauAList(bateau) ;
			}
			majVueBateauSlcted() ;
		}
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(e.getActionCommand() != "Editer"){
			//System.out.println(e.getActionCommand()) ;
			actionBateauSlcted(e.getActionCommand()) ;
		}else{
			PDF lePDF = null ;
			
			try {
				lePDF = new  PDF("Brochure.pdf");
				//System.out.println("Brochure de bateaux voyageurs");
				lePDF.ecrireTexte("Brochure de bateaux voyageurs");
				for( BateauVoyageur unBateau : listBateauxSlcted ){
					lePDF.ecrireTexte(System.getProperty("line.separator")) ;
					lePDF.ecrireTexte(unBateau.getNom());
					lePDF.ecrireTexte(System.getProperty("line.separator")) ;
					lePDF.chargerImage(unBateau.getImageBatVoyageur());
					lePDF.ecrireTexte(System.getProperty("line.separator")) ;
					lePDF.ecrireTexte(unBateau.toString());
					lePDF.ecrireTexte(System.getProperty("line.separator")) ;
				}
			} catch (FileNotFoundException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			} catch (DocumentException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			} catch (MalformedURLException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			} catch (IOException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}finally{
				lePDF.fermer() ;
		        System.out.println("Document PDF  generated");
		        this.textBateauxSlcted.append(System.getProperty("line.separator")+"Document PDF généré!");
			}
		}
	}

}
