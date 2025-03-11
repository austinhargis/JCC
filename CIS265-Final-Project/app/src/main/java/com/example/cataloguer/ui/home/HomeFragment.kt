package com.example.cataloguer.ui.home

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.databinding.DataBindingUtil
import androidx.fragment.app.Fragment
import androidx.lifecycle.ViewModelProviders
import com.example.cataloguer.R
import com.example.cataloguer.database.CataloguerDatabase
import com.example.cataloguer.databinding.FragmentHomeBinding

class HomeFragment : Fragment() {

    private lateinit var homeViewModel: HomeViewModel

    override fun onCreateView(
            inflater: LayoutInflater,
            container: ViewGroup?,
            savedInstanceState: Bundle?
    ): View? {
        // creates the binding
        val binding: FragmentHomeBinding = DataBindingUtil.inflate(inflater, R.layout.fragment_home, container, false)

        // create application and data variables required for building the viewModelFactory
        val application = requireNotNull(this.activity).application
        val dataSource = CataloguerDatabase.getInstance(application).cataloguerDatabaseDao
        val viewModelFactory = HomeViewModelFactory(dataSource, application)

        // create the actual viewModelFactory
        val homeViewModel = ViewModelProviders.of(this, viewModelFactory).get(HomeViewModel::class.java)

        binding.setLifecycleOwner(this)
        binding.homeViewModel = homeViewModel

        // returns the root
        return binding.root
    }
}