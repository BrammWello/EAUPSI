package testone;

import java.net.InetSocketAddress;

import com.datastax.oss.driver.api.core.CqlIdentifier;
import com.datastax.oss.driver.api.core.CqlSession;
import com.datastax.oss.driver.api.core.CqlSessionBuilder;
import com.datastax.oss.driver.api.core.cql.ResultSet;
import com.datastax.oss.driver.api.core.cql.Row;
import com.datastax.oss.driver.api.querybuilder.SchemaBuilder;
import com.datastax.oss.driver.api.querybuilder.schema.CreateKeyspace;

public class CassandraConnector {
    private CqlSession session;

    public void connect(String node, Integer port, String dataCenter) {
        CqlSessionBuilder builder = CqlSession.builder();
        builder.addContactPoint(new InetSocketAddress(node, port));
        builder.withLocalDatacenter(dataCenter);

        session = builder.withKeyspace("classattendance").build();

        // readFiles();
    }

    private void readFiles() {

        String rowID, rowName = null;
        ResultSet rs = session.execute("SELECT * FROM test");
        for (Row row : rs) 
        {
            rowID = Integer.toString(row.getInt("test_id"));
            rowName = row.getString("test_name");
            System.out.print("ID is " + rowID);
            System.out.println("Name is " + rowName);
        }
    }

    public CqlSession getSession() {
        return this.session;
    }

    public void close() {
        session.close();
    }

    public void createKeyspace(String keyspaceName, int numberOfReplicas) {
        CreateKeyspace createKeyspace = SchemaBuilder.createKeyspace(keyspaceName)
          .ifNotExists()
          .withSimpleStrategy(numberOfReplicas);

        session.execute(createKeyspace.build());
    }

    public void useKeyspace(String keyspace) {
        session.execute("USE " + CqlIdentifier.fromCql(keyspace));
    }


}
