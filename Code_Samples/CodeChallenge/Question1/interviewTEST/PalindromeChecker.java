//package question1;

//import rx.Observable;

/**
 * Computer scientist Peter Norvig is known (among other things) for creating the world's longest
 * actual word palindrome of >70,000 letters and >17,000 words. It's basically a super long list of
 * nouns. I went ahead and removed all punctuation and spaces and lower cased the letters for you so
 * don't worry about coercing into a prettier form. I've also provided a shorter palindrome to use
 * as a test case as you go.
 *
 * Implement these interface methods according to the instructions given for each. When you're all
 * set, add your implementation to the PalindromeCheckerTest setup() method and run. Add your own
 * test cases for brownie points!
 *
 * Please take copious notes on your thought process as you go through these exercises. We're trying
 * to understand how you solve problems as well your understanding of the the Java language,
 * algorithms and design patterns.
 *
 * Good luck and email connor.mathews@constanttherapy.com if you have any questions!
 */
public interface PalindromeChecker {
    // TODO update this path with the absolute path (including /) of the parent directory of /interview
    String PATH = "/Users/paavanchopra/Documents/interviewTest/";

    /**
     * Warm up!
     *
     * This is the good 'ole "is this string a palindrome" interview question. Try and finish this
     * fast and don't worry about optimizations. This is just to get you rolling.
     */
    boolean quickAndDirtyIsPalindrome(String palindrome);

    /**
     * Now that you've gotten started, try and write the fastest palindrome algorithm that you can.
     * Please explain why it's fast in terms of computer science, your machine and Java quirks. Feel
     * free to experiment with a few different approaches. Hint: it's really helpful to dive into
     * the source code as well as Google-ing mechanics like class/method table lookups, jumps,
     * memory look ups and copies.
     */
    boolean fastIsPalindrome(String palindrome);

    /**
     * Now that you've brainstormed some improvements to your palindrome verifying algorithm, create
     * a static class within PalindromeChecker that allows you to swap in-between these algorithms
     * at runtime. This will require you to refactor your previous code, but for now please copy
     * rather than rewrite if your code requires extensive modifications so so that we can see what
     * you've previously done. Delegate to the fastest algorithm that you found in the previous
     * exercise and explain any differences in the results.
     */
    boolean designPatternsIsPalindrome(String palindrome);

    /**
     * Now you need to find the longest palindromic substring of the original large test, minus the
     * character. The run time of solutions to this problem can vary from n log n to n ^ 3. Feel
     * free to use Google and any open source code you find.
     */
    String largestPalindromeSubstring(String palindrome);

    /*
     * Follow up: please write a little about how you feel about the Java language, pros and cons, \
     * and different approaches you've taken to tackling its cons.
     * 
     * Sime java pros are that you don've have to worry about pointers and that is OOP.
     * 
     * The advantage of OOP is that the code is well structured, easy to understand and 
     * one take advantage of the different objects and classes to save information for a specific entity.
     * 
     * The cons are that java is not nearly as flexible as other languages.  Every variable has to have a type and
     * there aren't alot of simple one liners (like a for loop in python).  The only way of dealing with specific java types
     * is by making a custom object of your own. As far being able to write a for loop in one line, a lot java libraries exist
     * in which you can do simple things without having to make everything from scratch, like hashmap.  Also there are no mutable types unless
     * you use a java library or create your own nodes.
     * 
     */
}


