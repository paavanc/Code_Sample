import org.junit.Before;
import org.junit.Test;
import java.lang.Object;
//import question1.PalindromeChecker;
//import question1.PalindromeCheckerCorrect;
//import question1.PalindromeSource;
//import rx.schedulers.Schedulers;
import org.junit.Assert;
//import org.assertj.core.api.Assertions.assertThat;
//import static question1.PalindromeSource.longestPalindrome;
//import static question1.PalindromeSource.longestSubPalindrome;
//import static question1.PalindromeSource.simplePalindrome;

public class PalindromeCheckerTest {
    private static final int reps = 100;

    //PalindromeChecker palindromeChecker;
     
    long startTime;

    private double average(long[] durations) {
        double sum = 0d;
        for (int ii = 0; ii < durations.length; ii++) {
            sum += 1.0d * durations[ii];
        }
        return sum / durations.length;
    }

    @Before
    public void setup()  {
         PalindromeSource palindromeSource = new PalindromeSource() ;
        PalindromeCheckList palindromeChecker = new PalindromeCheckList();
            // TODO
        String longest = palindromeSource.longestPalindrome();
        //assertThat(longest).isNotEmpty();
    }

    @Test
    public void testIsPalindrome() {
         PalindromeSource palindromeSource = new PalindromeSource() ;
        PalindromeCheckList palindromeChecker = new PalindromeCheckList();
      
        long[] durations = new long[reps - 1];
        for (int ii = 0; ii < reps; ii++) {
            startTime = System.nanoTime();
            boolean isPalindrome = palindromeChecker.quickAndDirtyIsPalindrome(palindromeSource.longestPalindrome());
            if (ii != 0) {
                // Throw out first result b/c of class loader.
                durations[ii - 1] = System.nanoTime() - startTime;
                System.out.println(durations[ii - 1]);
            }
            //assertThat(isPalindrome).isTrue();
        }
        System.out.print("Average: ");
        System.out.print(average(durations) / 1000);
        System.out.println("ms");
    }

    @Test
    public void testFastIsPalindrome()  {
         PalindromeSource palindromeSource = new PalindromeSource() ;
        PalindromeCheckList palindromeChecker = new PalindromeCheckList();
        long[] durations = new long[reps - 1];
        for (int ii = 0; ii < reps; ii++) {
            startTime = System.nanoTime();
            boolean isPalindrome = palindromeChecker.fastIsPalindrome(palindromeSource.longestPalindrome());
            if (ii != 0) {
                // Throw out first result b/c of class loader.
                durations[ii - 1] = System.nanoTime() - startTime;
                System.out.println(durations[ii - 1]);
            }
            //assertThat(isPalindrome).isTrue();
        }
        System.out.print("Average: ");
        System.out.print(average(durations) / 1000);
        System.out.println("ms");
    }

    @Test
    public void testDesignPatternIsPalindrome()  {
         PalindromeSource palindromeSource = new PalindromeSource() ;
        PalindromeCheckList palindromeChecker = new PalindromeCheckList();
        long[] durations = new long[reps - 1];
        for (int ii = 0; ii < reps; ii++) {
            startTime = System.nanoTime();
            boolean isPalindrome = palindromeChecker.designPatternsIsPalindrome(palindromeSource.longestPalindrome());
            if (ii != 0) {
                // Throw out first result b/c of class loader.
                durations[ii - 1] = System.nanoTime() - startTime;
                System.out.println(durations[ii - 1]);
            }
            //assertThat(isPalindrome).isTrue();
        }
        System.out.print("Average: ");
        System.out.print(average(durations) / 1000);
        System.out.println("ms");
    }

    @Test
    public void testSubPalindromes(){
         PalindromeSource palindromeSource = new PalindromeSource() ;
        PalindromeCheckList palindromeChecker = new PalindromeCheckList();
        long[] durations = new long[reps - 1];
        for (int ii = 0; ii < reps; ii++) {
            startTime = System.nanoTime();
            String longestSubstringPalindrome = palindromeChecker.largestPalindromeSubstring(
                    palindromeSource.longestSubPalindrome());
            if (ii != 0) {
                // Throw out first result b/c of class loader.
                durations[ii - 1] = System.nanoTime() - startTime;
            }
            //assertThat(longestSubstringPalindrome).isNotEmpty();
            boolean isPalindrome = palindromeChecker.fastIsPalindrome(longestSubstringPalindrome);
            //assertThat(isPalindrome).isTrue();
        }
        System.out.print("Average: ");
        System.out.print(average(durations) / 1000);
        System.out.println("ms");
    }
    
      
   public static void main(String[] args) {
     PalindromeCheckerTest run = new PalindromeCheckerTest();
     
     //Unit Tests
     
     System.out.println("testIsPalindrome");
     run.testIsPalindrome();
     System.out.println();
      System.out.println("testFastIsPalindrome");
     run.testFastIsPalindrome();
     System.out.println();
   System.out.println("testDesignPatternIsPalindrome");
     run.testDesignPatternIsPalindrome();
     System.out.println();
      System.out.println("testSubPalindromes");
     run.testSubPalindromes();
     System.out.println();
     /*
      * Observations:
      * 
      * To no surprise, the fast palindrom clearly outperforms the quick and dirty one.
      * As far as te design pattern algorithm, it actually performs better on average than the fast palindrom method.
      * After running this program at least ten times, the design pattern algorithm usually beat the fast one.
      * 
      * Based on this assignment and what I've read online, the fight between abstraction and performance really depends.
      * If classes are written well, we may increase spead, but if they are very big and complex in nature, the opposite may happen.
      * Performance is always important, but abstraction helps us understand the code base as it gets more complicated.
      * 
      * Abstraction can lead to a lot of communication and synchronization oversite. So we should only use it if it makes
      * sense for the mobile applicaiton.  If we care about data consistancy and serializability, it is important.
      * 
      * 
      */
     
     
   }
}
