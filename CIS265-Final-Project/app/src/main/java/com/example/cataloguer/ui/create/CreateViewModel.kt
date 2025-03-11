package com.example.cataloguer.ui.create

import android.app.Application
import android.util.Log
import androidx.lifecycle.AndroidViewModel
import androidx.lifecycle.MutableLiveData
import com.example.cataloguer.R
import com.example.cataloguer.database.CataloguerDB
import com.example.cataloguer.database.CataloguerDatabaseDao
import kotlinx.coroutines.*

class CreateViewModel(val database: CataloguerDatabaseDao, application: Application) : AndroidViewModel(application) {

    private var viewModelJob = Job()
    private val uiScope = CoroutineScope(Dispatchers.Main + viewModelJob)

    private var entry = MutableLiveData<CataloguerDB?>()

    override fun onCleared() {
        super.onCleared()
        viewModelJob.cancel()
    }

    private suspend fun insert(entry: CataloguerDB) {
        withContext(Dispatchers.IO) {
            database.insert(entry)
        }
    }

    fun onInsertData() {
        Log.d("TestLog", "Button pressed")
//        val test = R.id.entryTextAuthorName.text.toString()
//        Log.d("TestLog", "$test")
        uiScope.launch {
            val entry = CataloguerDB(0, R.id.entryTextTitleName.toString(), R.id.entryTextAuthorName.toString(), R.id.entryTextReleaseYear.toInt(), R.id.entryTextSpecialInformation.toString())
            Log.d("TestLog", "$entry")
            insert(entry)
        }
    }
}