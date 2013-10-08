import java.io.BufferedWriter;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.OutputStreamWriter;
import java.io.Writer;
import java.io.PrintWriter;

public class Compiler {
    public static void main(String[] args) {
		PrintWriter writer = new PrintWriter("File.txt", "UTF-8");
		writer.println("The first line");
		writer.println("The second line");
		writer.close();
    }
}  