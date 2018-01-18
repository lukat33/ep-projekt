package ep.rest;

import android.content.Intent;
import android.os.Bundle;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ListView;
import android.widget.Toast;

import java.io.IOException;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class MainActivity extends AppCompatActivity implements Callback<List<Book>> {
    private static final String TAG = MainActivity.class.getCanonicalName();

    private SwipeRefreshLayout container;
    private Button button;
    private ListView list;
    private BookAdapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        list = (ListView) findViewById(R.id.items);

        adapter = new BookAdapter(this);
        list.setAdapter(adapter);
        list.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                final Book book = adapter.getItem(i);
                if (book != null) {
                    final Intent intent = new Intent(MainActivity.this, BookDetailActivity.class);
                    intent.putExtra("ep.rest.id", book.id);
                    startActivity(intent);
                }
            }
        });

        container = (SwipeRefreshLayout) findViewById(R.id.container);
        container.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                BookService.getInstance().getAll().enqueue(MainActivity.this);
            }
        });

        button = (Button) findViewById(R.id.add_button);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                final Intent intent = new Intent(MainActivity.this, BookFormActivity.class);
                startActivity(intent);
            }
        });

        BookService.getInstance().getAll().enqueue(MainActivity.this);
    }

    @Override
    public void onResponse(Call<List<Book>> call, Response<List<Book>> response) {
        final List<Book> hits = response.body();

        if (response.isSuccessful()) {
            Log.i(TAG, "Hits: " + hits.size());
            adapter.clear();
            adapter.addAll(hits);
        } else {
            String errorMessage;
            try {
                errorMessage = "An error occurred: " + response.errorBody().string();
            } catch (IOException e) {
                errorMessage = "An error occurred: error while decoding the error message.";
            }
            Toast.makeText(this, errorMessage, Toast.LENGTH_SHORT).show();
            Log.e(TAG, errorMessage);
        }
        container.setRefreshing(false);
    }

    @Override
    public void onFailure(Call<List<Book>> call, Throwable t) {
        Log.w(TAG, "Error: " + t.getMessage(), t);
        container.setRefreshing(false);
    }
}
