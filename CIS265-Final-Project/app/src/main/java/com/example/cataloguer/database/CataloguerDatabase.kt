package com.example.cataloguer.database

import android.content.Context
import androidx.room.Database
import androidx.room.Room
import androidx.room.RoomDatabase

@Database(entities = [CataloguerDB::class], version = 1, exportSchema = false)
abstract class CataloguerDatabase : RoomDatabase() {

    abstract val cataloguerDatabaseDao: CataloguerDatabaseDao

    companion object {

        @Volatile
        private var INSTANCE: CataloguerDatabase? = null

        fun getInstance(context: Context): CataloguerDatabase {
            synchronized(this) {
                var instance = INSTANCE

                if (instance == null) {
                    instance = Room.databaseBuilder(
                            context.applicationContext,
                            CataloguerDatabase::class.java,
                            "cataloguer_database"
                    ).fallbackToDestructiveMigration().build()
                    INSTANCE = instance
                }
                return instance
            }
        }
    }
}