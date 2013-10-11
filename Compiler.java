import java.io.FileNotFoundException;
import java.io.UnsupportedEncodingException;
import java.io.PrintWriter;

public class Compiler {
    public static void main(String[] args) {
		PrintWriter writer;
		try {
			//writer = new PrintWriter("C:\\Users\\johnsond\\Documents\\NJIT Classes\\CS 490 (Design in Software Engineer)\\cs490\\Text.txt", "UTF-8");
			writer = new PrintWriter("/afs/cad/u/d/j/dj65/public_html/cs490/output/NewText.txt", "UTF-8");
			writer.println(args[0]); 
			writer.close();
		} catch (FileNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace(); 
		} catch (UnsupportedEncodingException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

    }
}  