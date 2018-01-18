package ep.rest;

import java.io.Serializable;
import java.util.Locale;

public class Book implements Serializable {
    public int id, year;
    public String author, name, uri, description;
    public double price;

    @Override
    public String toString() {
        return String.format(Locale.ENGLISH,
                "%s: %s, %d (%.2f EUR)",
                author, name, year, price);
    }
}
