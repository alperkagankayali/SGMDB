import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;

/**
 * 	Driver class for JDBC connection to MySQL
 *
 *	@author Fuad Aghazada
 *	@date 24/03/2018
 */

public class Driver
{
    // Constants
    private static String jdbc_driver = "com.mysql.jdbc.Driver";
    private static String url = "jdbc:mysql://localhost:3306/SGMDB";	  		//jdbc:mysql://dijkstra.ug.bcc.bilkent.edu.tr/fuad_aghazada
    private static String username = "root";													//fuad.aghazada
    private static String password = "";														//r82ehmg5

    /**
     *	Main method to execute.
     */
    public static void main(String[] args)
    {
        try
        {
            String [] playerAttributes = {"player_id-INT AUTO_INCREMENT", "email-CHAR(255) UNIQUE", "username-CHAR(255) UNIQUE", "password-CHAR(255)", "firstname-VARCHAR(255)", "middlename-VARCHAR(255)",
                    "lastname-VARCHAR(255)", "birth_date-DATE", "profile_picture-VARCHAR(255)", "status-INT", "age-INT", "PRIMARY KEY(player_id)" };

            String [] companyAttributes = {"company_name-VARCHAR(255)", "company_email-VARCHAR(255) UNIQUE", "company_logo-VARCHAR(255)", "company_password-CHAR(255)", "rating-FLOAT", "PRIMARY KEY(company_name)"};

            String [] developerAttributes = {"developer_id-INT AUTO_INCREMENT", "developer_email-VARCHAR(255) UNIQUE", "developer_password-CHAR(255)", "developer_firstname-VARCHAR(255)", "developer_midname-VARCHAR(255)", "developer_lastname-VARCHAR(255)", "PRIMARY KEY(developer_id)" };

            String [] gameAttributes = {"game_name-VARCHAR(255)", "game_price-FLOAT", "platform-VARCHAR(255)", "game_category-VARCHAR(255)", "game_logo-VARCHAR(255)", "rating-FLOAT", "system_requirements-VARCHAR(255)", "release_date-DATE", "company_name-VARCHAR(255)", "PRIMARY KEY(game_name)", "FOREIGN KEY(company_name) REFERENCES company(company_name)"};

            String [] wishListAttributes = {"game_name-VARCHAR(255) NOT NULL", "player_id-INT NOT NULL", "PRIMARY KEY(player_id, game_name)", "FOREIGN KEY(player_id) REFERENCES player(player_id)", "FOREIGN KEY(game_name) REFERENCES game(game_name)"};

            String [] cartAttributes = {"game_name-VARCHAR(255) NOT NULL", "player_id-INT NOT NULL", "PRIMARY KEY(player_id, game_name)", "FOREIGN KEY(player_id) REFERENCES player(player_id)", "FOREIGN KEY(game_name) REFERENCES game(game_name)"};

            String [] statsAttributes = {"stats_id-INT AUTO_INCREMENT", "last_active_date-DATE", "level-INT", "player_id-INT", "PRIMARY KEY(stats_id)", "FOREIGN KEY(player_id) REFERENCES player(player_id)"};

            String [] walletAttributes = {"wallet_id-INT AUTO_INCREMENT", "payment_method-VARCHAR(255)", "balance-FLOAT", "card_number-INT", "expiration_date-DATE", "security_code-INT", "player_id-INT", "PRIMARY KEY(wallet_id)", "FOREIGN KEY(player_id) REFERENCES player(player_id)"};

            String [] paymentAttributes = {"payment_id-INT AUTO_INCREMENT", "payment_date-DATE", "cost-FLOAT", "wallet_id-INT", "PRIMARY KEY(payment_id)", "FOREIGN KEY(wallet_id) REFERENCES wallet(wallet_id)"};

            String [] buyGameAttributes = {"player_id-INT NOT NULL", "payment_id-INT NOT NULL", "game_name-VARCHAR(255) NOT NULL", "PRIMARY KEY(player_id, payment_id, game_name)", "FOREIGN KEY(player_id) REFERENCES player(player_id)", "FOREIGN KEY(payment_id) REFERENCES payment(payment_id)", "FOREIGN KEY(game_name) REFERENCES game(game_name)"};

            String [] libraryAttributes = {"game_name-VARCHAR(255) NOT NULL", "player_id-INT NOT NULL", "PRIMARY KEY(player_id, game_name)", "FOREIGN KEY(player_id) REFERENCES player(player_id)", "FOREIGN KEY(game_name) REFERENCES game(game_name)"};

            String [] reviewAttributes = { "review_id-INT AUTO_INCREMENT", "review_text-TEXT", "review_date-DATE", "PRIMARY KEY(review_id)"};

            String [] writesAttributes = { "review_id-INT NOT NULL", "game_name-VARCHAR(255) NOT NULL", "player_id-INT NOT NULL", "PRIMARY KEY(review_id, game_name, player_id)", "FOREIGN KEY(game_name) REFERENCES game(game_name)", "FOREIGN KEY(review_id) REFERENCES review(review_id)", "FOREIGN KEY(player_id) REFERENCES player(player_id)"};

            String [] gameExpAttributes = { "experience-INT", "play_hour-FLOAT", "game_name-VARCHAR(255) NOT NULL", "player_id-INT NOT NULL", "PRIMARY KEY(game_name, player_id)", "FOREIGN KEY(player_id) REFERENCES player(player_id)", "FOREIGN KEY(game_name) REFERENCES game(game_name)"};

            String [] friendshipAttributes = { "player_id1-INT NOT NULL", "player_id2-INT NOT NULL", "since_date-DATE NOT NULL", "PRIMARY KEY(player_id1, player_id2)", "FOREIGN KEY(player_id1) REFERENCES player(player_id)", "FOREIGN KEY(player_id2) REFERENCES player(player_id)"};

            String [] playAttributes = {"session_id-INT AUTO_INCREMENT", "player_id1-INT NOT NULL", "player_id2-INT", "game_name-VARCHAR(255) NOT NULL", "session_date-DATE NOT NULL", "PRIMARY KEY(session_id)", "FOREIGN KEY(player_id1) REFERENCES player(player_id)", "FOREIGN KEY(player_id2) REFERENCES player(player_id)", "FOREIGN KEY(game_name) REFERENCES game(game_name)"};

            String [] notificationAttributes = {"notification_id-INT AUTO_INCREMENT", "notification_text-VARCHAR(255)", "notification_date-DATE", "notification_status-INT", "PRIMARY KEY(notification_id)"};

            String [] notifyAttributes = {"notification_id-INT NOT NULL", "player_id-INT NOT NULL", "PRIMARY KEY(notification_id, player_id)", "FOREIGN KEY(player_id) REFERENCES player(player_id)", "FOREIGN KEY(notification_id) REFERENCES notification(notification_id)"};


            String [] messageAttributes = { "player_id1-INT NOT NULL", "player_id2-INT NOT NULL", "time-timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP", "text-VARCHAR(255)", "PRIMARY KEY(player_id1, player_id2, time)", "FOREIGN KEY(player_id1) REFERENCES Player(player_id)", "FOREIGN KEY(player_id2) REFERENCES Player(player_id)"};
//            dropTable("player");
//            dropTable("company");
//            dropTable("developer");
//            dropTable("wishlist");
//            dropTable("cart");
//            dropTable("game");
//            dropTable("stats");
//            dropTable("wallet");
//			dropTable("buyGame");
//			dropTable("payment");
//			dropTable("library");
//			dropTable("writes");
//			dropTable("review");
//			dropTable("game_experience");
//			dropTable("friendship");
//			dropTable("play");
//
//            dropTable("notify");
//            dropTable("notification");


            //createTable("notification", notificationAttributes);
            //createTable("notify", notifyAttributes);

			/*createTable("play", playAttributes);
			createTable("game_experience", gameExpAttributes);
			createTable("friendship", friendshipAttributes);

			createTable("review", reviewAttributes);
			createTable("writes", writesAttributes);

			createTable("library", libraryAttributes);
			createTable("payment", paymentAttributes);
			createTable("buyGame", buyGameAttributes);
            createTable("wallet", walletAttributes);
            createTable("stats", statsAttributes);
            createTable("wishlist", wishListAttributes);
            createTable("cart", cartAttributes);
            createTable("game", gameAttributes);
            createTable("player", playerAttributes);
            createTable("company", companyAttributes);
            createTable("developer", developerAttributes);*/
            dropTable("message");
			createTable("message", messageAttributes);


        }
        catch(Exception e)
        {
            e.printStackTrace();
        }
    }

    /**
     *	Accessing the connection to the database
     */
    public static Connection accessConnection() throws Exception
    {
        Class.forName(jdbc_driver);

        Connection connection = DriverManager.getConnection(url, username, password);

        return connection;
    }

    /**
     *	Creating a table in the database with given name and attributes
     *	@param table_name : name of the table created
     *	@param attributes : attributes of the table created
     */
    public static void createTable(String table_name, String...attributes) throws Exception
    {
        try
        {
            String values = "(";

            for(int i = 0; i < attributes.length; i++)
            {
                String [] splitted = attributes[i].split("-");

                for(String s : splitted)
                    values += s + " ";

                if(i != attributes.length - 1)
                    values += ", ";
                else
                    values += ")";
            }

            String sqlStatement = "CREATE TABLE " + table_name + values + " ENGINE=InnoDB;";


            System.out.println(sqlStatement);

            PreparedStatement creating = accessConnection().prepareStatement(sqlStatement);

            creating.executeUpdate();
        }
        catch(Exception e)
        {
            e.printStackTrace();
        }
    }

    /**
     *	Inserting an element into the table with the following attributes.
     *	@param table_name: name of the table.
     *	@param attributes: attributes of the given table.
     */
    public static void insert(String table_name, String...attributes) throws Exception
    {
        try
        {
            String values = "(";

            if(attributes.length % 2 != 0)
            {
                System.out.println("There is a mismatch! Check the function input!");

                return;
            }

            for(int i = 0; i < attributes.length; i++)
            {
                if(i == attributes.length / 2)
                {
                    values += ") VALUES (";
                }
                if((i > 0 && i < attributes.length / 2) || (i > attributes.length / 2 && i < attributes.length))
                {
                    values += ", ";
                }

                if(i > attributes.length / 2)
                {
                    if(attributes[i].matches("[a-zA-Z]*") || attributes[i].contains("-"))
                    {
                        values += "'" + attributes[i] + "'";
                    }
                    else
                    {
                        values += attributes[i];
                    }
                }
                else
                {
                    values += attributes[i];
                }

            }

            String sqlStatement = "INSERT INTO " + table_name + values + ")";

            System.out.println(sqlStatement);

            PreparedStatement inserting = accessConnection().prepareStatement(sqlStatement);

            inserting.executeUpdate();
        }
        catch(Exception e)
        {
            e.printStackTrace();
        }
        finally
        {
            System.out.println("--INSERTED TUPLE--");
        }
    }

    /**
     *	Selecting the content of the table with the following name
     *	@table_name: name of the table.
     *	@attributes: attributes of the given table.
     */
    public static ArrayList<String> selectAll(String table_name, String...attributes) throws Exception
    {
        ArrayList<String> selection_result = new ArrayList<>();

        try
        {
            String sqlStatement = "SELECT * FROM " + table_name;

            PreparedStatement selectionAll = accessConnection().prepareStatement(sqlStatement);

            ResultSet result_set = selectionAll.executeQuery();

            while(result_set.next())
            {
                String tuple = "";

                for(String s : attributes)
                {
                    if(s.split("-").length != 1)
                        tuple += result_set.getString(s.split("-")[0]) + "  ";
                }


                System.out.println(tuple);
            }

        }
        catch(Exception e)
        {
            e.printStackTrace();
        }

        return selection_result;
    }

    /**
     *	Dropping the table - for recreating if it exists already
     *	@param table_name: name of the table given.
     */
    public static void dropTable(String table_name) throws Exception
    {
        try
        {
            String sqlStatement = "DROP TABLE IF EXISTS " + table_name + ";";

            PreparedStatement dropping = accessConnection().prepareStatement(sqlStatement);

            dropping.executeUpdate();
        }
        catch(Exception e)
        {
            e.printStackTrace();
        }
    }
}
