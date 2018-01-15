package ep.rest;

import java.util.Locale;

/**
 * Created by andraz on 15/01/2018.
 */

public class Login {
    public String email, password;

    @Override
    public String toString() {
        return String.format(Locale.ENGLISH,
                "%s %s",
                email, password);
    }
}
