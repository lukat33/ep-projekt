package ep.rest;

import java.util.Locale;

/**
 * Created by andraz on 15/01/2018.
 */

public class Session {
    public int session_id;
    public String status, message;

    @Override
    public String toString() {
        return String.format(Locale.ENGLISH,
                "%s %s %d",
                status, message, session_id);
    }
}
