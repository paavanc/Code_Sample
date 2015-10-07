
import java.lang.StringBuilder;
import java.util.Arrays;

public class PalindromeCheckList implements PalindromeChecker{
  
  /*
   * The easiest approach is just to compare the reversed string to the original and see if they match.
   */
  public boolean quickAndDirtyIsPalindrome(String palindrome){
    
    if(palindrome.equals(new StringBuilder(palindrome).reverse().toString())){
     return true; 
      
    }
    
    
      return false;

    
  }
  
  /*
   * In case of bigger strings, the first approach is too expensive. Reversing the string and storing it
   * takes up double memory.
   * 
   * This next approach assumes the second half of the string mirrors the first, since that's a palindrome.
   * We just compare the end of the string to the start and see if they match.  Then we iterate through the string by
   * comparing a pair of characters at a time incrementing from the beginning and end of the string.
   * 
   * If all pairs match, it's a palindrome.  This works in one iteration.
   */
  public  boolean fastIsPalindrome(String palindrome){
    int start =0 ; //start pointer
    
    int end = palindrome.length()-1; //end pointer
    
    while (end > start){ //continues while loop till we reach mid point of the string
      
      
      if (palindrome.charAt(start)!= palindrome.charAt(end)){ //check if match
        
       return false; 
      }
      //update pointets
      end--;
      start++;
      
    }
    
    return true;
  
  }
  
  /*
   * Still not completly sure what Connor wanted, so I took my best guess
   * this method creats an object based of the static class and uses its palindrome methods we created earlier
   * 
   */
  public boolean designPatternsIsPalindrome(String palindrome){
    Design pali = new Design();
    boolean flag;
    flag = pali.fastIsPalindrome(palindrome);
    return flag;
    
  }
  
  

  
  //uses Manachers algorithm..can be found here https://en.wikipedia.org/wiki/Longest_palindromic_substring
  //Time complexity is O(n)
  //Works in O(n) time because we go boundry by boundry
  /*
   * The algorithm is complicated, but takes advantage of all a palindrome's properties, plus runs the fastest.
   * Why not the best? Right?
   * 
   * First the left side of the palindrome mirrors the right.
   * Case 1 - third palindrome whose center is right of first palindrome will have the same length as seconde palindrome
   * mirrored on left side of first palindrome
   * etc -rules expanded upon in wikipedia
   * palindrome = # of chacacters (N)
   * s2= N*2 +1
   * p is an array of the elements of s2 ranging from center to the left
   * c is the center of the palindrome closest to the right  of s2 (the length of the palindrome = p[c]*2+1)
   * r is the right most boundry of palindrome position, r = c + p[c]
   * i position of element to be determined, always on the right of c
   * i2 mirrored postion of i
   */
  public String largestPalindromeSubstring(String palindrome){
    
        if (palindrome==null || palindrome.length()==0)
            return "";
        
        char[] s2 = addBoundaries(palindrome.toCharArray());
        int[] p = new int[s2.length]; 
        int c = 0, r = 0; // Here the first element in s2 has been processed.
        int m = 0, n = 0; // The walking indices to compare if two elements are the same
        for (int i = 1; i<s2.length; i++) {
            if (i>r) {
                p[i] = 0; m = i-1; n = i+1;
            } else {
                int i2 = c*2-i;
                if (p[i2]<(r-i)) {
                    p[i] = p[i2];
                    m = -1; // This signals bypassing the while loop below. 
                } else {
                    p[i] = r-i;
                    n = r+1; m = i*2-n;
                }
            }
            while (m>=0 && n<s2.length && s2[m]==s2[n]) {
                p[i]++; m--; n++;
            }
            if ((i+p[i])>r) {
                c = i; r = i+p[i];
            }
        }
        int len = 0; c = 0;
        for (int i = 1; i<s2.length; i++) {
            if (len<p[i]) {
                len = p[i]; c = i;
            }
        }
        char[] ss = Arrays.copyOfRange(s2, c-len, c+len+1);
        return String.valueOf(removeBoundaries(ss));
    }
  
  //add boundries  so we can follow the rules and see palindromes within palindromes
      private static char[] addBoundaries(char[] cs) {
        if (cs==null || cs.length==0)
            return "||".toCharArray();

        char[] cs2 = new char[cs.length*2+1];
        for (int i = 0; i<(cs2.length-1); i = i+2) {
            cs2[i] = '|';
            cs2[i+1] = cs[i/2];
        }
        cs2[cs2.length-1] = '|';
        return cs2;
    }

      //remove boundries so we can send the longest palindromic string
    private static char[] removeBoundaries(char[] cs) {
        if (cs==null || cs.length<3)
            return "".toCharArray();

        char[] cs2 = new char[(cs.length-1)/2];
        for (int i = 0; i<cs2.length; i++) {
            cs2[i] = cs[i*2+1];
        }
        return cs2;
    } 
    
    

  
   public static void main(String[] args) {
     
     //Unit Test
     PalindromeSource string =  new PalindromeSource();
     
     
     
     PalindromeCheckList test =  new PalindromeCheckList();
     System.out.println("Unit Tests");
     System.out.println("quickAndDirtyIsPalindrome:");
     System.out.println(test.quickAndDirtyIsPalindrome(string.simplePalindrome()));
     System.out.println(test.quickAndDirtyIsPalindrome(string.longestPalindrome()));
     System.out.println(test.quickAndDirtyIsPalindrome(string.longestSubPalindrome()));
     System.out.println(test.quickAndDirtyIsPalindrome("iiiilikehotdogsiiii"));
     System.out.println();
      System.out.println("fastIsPalindrome:");
     System.out.println(test.fastIsPalindrome(string.simplePalindrome()));
     System.out.println(test.fastIsPalindrome(string.longestPalindrome()));
     System.out.println(test.quickAndDirtyIsPalindrome(string.longestSubPalindrome()));
     System.out.println(test.fastIsPalindrome("iiiilikehotdogsiiii"));
     System.out.println();
          System.out.println("designPatternsIsPalindrome:");
     System.out.println(test.designPatternsIsPalindrome(string.simplePalindrome()));
     System.out.println(test.designPatternsIsPalindrome(string.longestPalindrome()));
     System.out.println(test.designPatternsIsPalindrome(string.longestSubPalindrome()));
     System.out.println(test.designPatternsIsPalindrome("iiiilikehotdogsiiii"));
     System.out.println();
    System.out.println("largestPalindromeSubstring:");
     System.out.println(test.largestPalindromeSubstring(string.simplePalindrome()));
     System.out.println(test.largestPalindromeSubstring(string.longestPalindrome()));
     System.out.println(test.quickAndDirtyIsPalindrome(string.longestSubPalindrome()));
       System.out.println(test.largestPalindromeSubstring("1234"));
        System.out.println(test.largestPalindromeSubstring("12321"));
        System.out.println(test.largestPalindromeSubstring("9912321456"));
        System.out.println(test.largestPalindromeSubstring("9912333321456"));
        System.out.println(test.largestPalindromeSubstring("12145445499"));
        System.out.println(test.largestPalindromeSubstring("1223213"));
        System.out.println(test.largestPalindromeSubstring("abb"));
     System.out.println(test.largestPalindromeSubstring("iiiilikehotdogsiiii"));
     System.out.println();

     
     
     
   }
   
   
   
   //public static class for   boolean designPatternsIsPalindrome(String palindrome);
   public static class Design{
     
       /*
   * The easiest approach is just to compare the reversed string to the original and see if they match.
   */
  public boolean quickAndDirtyIsPalindrome(String palindrome){
    
    if(palindrome.equals(new StringBuilder(palindrome).reverse().toString())){
     return true; 
      
    }
    
    
      return false;

    
  }
  
  /*
   * In case of bigger strings, the first approach is too expensive. Reversing the string and storing it
   * takes up double memory.
   * 
   * This next approach assumes the second half of the string mirrors the first, since that's a palindrome.
   * We just compare the end of the string to the start and see if they match.  Then we iterate through the string by
   * comparing a pair of characters at a time incrementing from the beginning and end of the string.
   * 
   * If all pairs match, it's a palindrome.  This works in one iteration.
   */
  public  boolean fastIsPalindrome(String palindrome){
    int start =0 ; //start pointer
    
    int end = palindrome.length()-1; //end pointer
    
    while (end > start){ //continues while loop till we reach mid point of the string
      
      
      if (palindrome.charAt(start)!= palindrome.charAt(end)){ //check if match
        
       return false; 
      }
      //update pointets
      end--;
      start++;
      
    }
    
    return true;
  
  }
     
     
     
   }
  
}