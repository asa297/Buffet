package info.androidhive.navigationdrawer.promotion;

/**
 * Created by AndroidBash on 09/05/2016.
 */
public class Movie {

    private int id;
    private String movieName;
    private String imageLink;
    private String movieGenre;

    public Movie(String movieName, String imageLink, String movieGenre) {

        this.movieName = movieName;
        this.imageLink = imageLink;
        this.movieGenre = movieGenre;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getMovieName() {
        return movieName;
    }

    public void setMovieName(String movieName) {
        this.movieName = movieName;
    }

    public String getImageLink() {
        return imageLink;
    }

    public void setImageLink(String imageLink) {
        this.imageLink = imageLink;
    }

    public String getMovieGenre() {
        return movieGenre;
    }

    public void setMovieGenre(String movieGenre) {
        this.movieGenre = movieGenre;
    }

}
