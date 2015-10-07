
import java.io.File;
import java.io.IOException;
import java.io.InputStream;
import java.net.URI;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.security.CodeSource;
import java.util.List;
import java.util.Scanner;
//import okio.BufferedSource;
//import okio.Okio;
//import rx.Observable;
//import rx.schedulers.Schedulers;
import sun.misc.IOUtils;
import sun.nio.ch.IOUtil;

public class PalindromeSource {

    public static String simplePalindrome() {
        return "docnoteidissentafastneverpreventsafatnessidietoncod";
    }

    public static String longestPalindrome() {
        Path path = Paths.get(URI.create(
                "file://" + PalindromeChecker.PATH +
                        "longest_palindrome"));
        List<String> lines = null;
        try {
            lines = Files.readAllLines(path);
        } catch (IOException e) {

        }
        String longestPalindrome = lines == null ? "" : lines.get(0);
        return longestPalindrome;
    }

    public static String longestSubPalindrome() {
        String longest = longestPalindrome();
        return longest.substring(0, longest.length() - 1);
    }

    /*
    public static Observable<Character> streamingPalindrome() {
        char[] basicChars = longestSubPalindrome().toCharArray();
        Character[] boxedChars = new Character[basicChars.length];
        for (int ii = 0, size = basicChars.length; ii < size; ii++) {
            boxedChars[ii] = basicChars[ii];
        }
        return Observable.from(boxedChars).subscribeOn(Schedulers.immediate())
                .observeOn(Schedulers.immediate());
    }
    */
}
