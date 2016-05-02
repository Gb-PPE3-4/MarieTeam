import static org.junit.Assert.*;

import org.junit.Before;
import org.junit.Test;


public class BateauTest {
	
	private Bateau bTest ;
	
	@Before
	public void setUp() throws Exception {
		bTest = new Bateau(13, "baTest", "13", "5", 0) ;
	}
	
	@Test
	public void testToString() {
		try{
			setUp() ;
			assertTrue("Erreur de conversion en chaine de caractères", bTest.toString() instanceof String);
		}catch(Exception e){
			System.out.println(e.getMessage()) ;
		}
	}
	
}
